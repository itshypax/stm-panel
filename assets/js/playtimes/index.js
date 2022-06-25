const CronJob = require('cron').CronJob;
const fetch = require('node-fetch');
require('dotenv').config()

const {Sequelize, DataTypes} = require('sequelize');

const sequelize = new Sequelize(process.env.MYSQL_DATABASE, process.env.MYSQL_USER, process.env.MYSQL_PASSWORD, {
    host: process.env.MYSQL_HOST,
    dialect: 'mysql',
    logging: console.log
});

const UserPlaytime = sequelize.define('UserPlaytime', {
    name: {
        type: DataTypes.STRING,
        allowNull: false,
        unique: true
    },
    playtime: {
        type: DataTypes.BIGINT,
        allowNull: false
    },
    online: {
        type: DataTypes.BOOLEAN,
        allowNull: false
    },
    server: {
        type: DataTypes.STRING,
        allowNull: true
    }
}, {});


// const SERVERURL = "http://localhost:3000/";
const SERVERURL = "https://api.realliferpg.de/v1/servers/";

let onlinePlayers = [];

async function crawlPlayers() {
    fetch(SERVERURL)
        .then(res => res.json())
        .then(servers => {
            servers.data.forEach(server => {
                if (server.Servername.includes('Gungame Server')) {
                    return;
                }
                const playerNames = server.Players;

                const tags = [
                    // '[C',
                    '[ST]'
                ];

                playerNames.forEach(originalUserName => {
                    const isInLobby = originalUserName.includes(' (Lobby)');
                    const playerName = originalUserName.replace(' (Lobby)', '')
                    if (!tags.some(tag => playerName.includes(tag))) {
                        return;
                    }
                    if (!onlinePlayers.includes(playerName)) {
                        if(!isInLobby) {
                            onlinePlayers.push(playerName);
                        }
                    }

                        upsert({
                                name: playerName,
                                playtime: sequelize.literal(`playtime + ${isInLobby ? 0 : 1}` ),
                                online: true,
                                server: server.Servername
                            },
                            {
                                name: playerName
                            });
                });


                onlinePlayers.forEach(async playerName => {
                    if (!playerNames.includes(playerName)) {
                        onlinePlayers.splice(onlinePlayers.indexOf(playerName), 1);

                        console.log(playerName + ' ist nun offline');
                        await UserPlaytime.update(
                            {
                                online: false,
                                server: null
                            },
                            {
                                where: {
                                    name: playerName
                                }
                            }
                        );
                    }
                });
                console.log("Server crawling of " + server.Servername + " finished");
            });
        })
        .catch(reason => {
            console.log("Error on fetching server lol or im retarded: " + reason);
        });

}

function upsert(values, condition) {
    return UserPlaytime
        .findOne({where: condition})
        .then(function (obj) {
            // update
            if (obj)
                return obj.update(values);
            // insert
            return UserPlaytime.create(values);
        })
}

async function startCrawling() {
    await sequelize.sync({alter: true});


    const job = new CronJob('* * * * *', crawlPlayers);
    job.start();
}

startCrawling();




