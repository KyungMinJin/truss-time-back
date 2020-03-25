DROP TABLE IF EXISTS teamtime;
DROP TABLE IF EXISTS timetable;
DROP TABLE IF EXISTS team;
DROP TABLE IF EXISTS timetable_temp;
DROP TABLE IF EXISTS reply;
DROP TABLE IF EXISTS phone;

CREATE TABLE `teamtime` (
    `teamname`          VARCHAR(20)    DEFAULT NULL,
    `monday_start`      TEXT    DEFAULT NULL,
    `monday_end`        TEXT    DEFAULT NULL,
    `tuesday_start`     TEXT    DEFAULT NULL,
    `tuesday_end`       TEXT    DEFAULT NULL,
    `wednesday_start`   TEXT    DEFAULT NULL,
    `wednesday_end`     TEXT    DEFAULT NULL,
    `thursday_start`    TEXT    DEFAULT NULL,
    `thursday_end`      TEXT    DEFAULT NULL,
    `friday_start`      TEXT    DEFAULT NULL,
    `friday_end`        TEXT    DEFAULT NULL,
    `saturday_start`    TEXT    DEFAULT NULL,
    `saturday_end`      TEXT    DEFAULT NULL,
    `sunday_start`      TEXT    DEFAULT NULL,
    `sunday_end`        TEXT    DEFAULT NULL,
    PRIMARY KEY (`teamname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `timetable` (
    `time`          INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `monday`        TEXT    DEFAULT NULL,
    `tuesday`       TEXT    DEFAULT NULL,
    `wednesday`     TEXT    DEFAULT NULL,
    `thursday`      TEXT    DEFAULT NULL,
    `friday`        TEXT    DEFAULT NULL,
    `saturday`      TEXT    DEFAULT NULL,
    `sunday`        TEXT    DEFAULT NULL,
    PRIMARY KEY (`time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `team` (
    `teamname`      VARCHAR(20)    DEFAULT NULL,
    `teampw`        TEXT    DEFAULT NULL,
    `vocal`         TEXT    DEFAULT NULL,
    `first`         TEXT    DEFAULT NULL,
    `second`        TEXT    DEFAULT NULL,
    `bass`          TEXT    DEFAULT NULL,
    `drum`          TEXT    DEFAULT NULL,
    `keyboard`      TEXT    DEFAULT NULL,
    `memo`          TEXT    DEFAULT NULL,
    `isTemp`        TEXT    DEFAULT NULL,
    `timelimit`     TEXT    DEFAULT NULL,
    PRIMARY KEY (`teamname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `timetable_temp` (
    `time`          INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `monday`        TEXT    DEFAULT NULL,
    `tuesday`       TEXT    DEFAULT NULL,
    `wednesday`     TEXT    DEFAULT NULL,
    `thursday`      TEXT    DEFAULT NULL,
    `friday`        TEXT    DEFAULT NULL,
    `saturday`      TEXT    DEFAULT NULL,
    `sunday`        TEXT    DEFAULT NULL,
    PRIMARY KEY (`time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `reply` (
    `teamname`      TEXT    DEFAULT NULL,
    `no`            INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `writer`        TEXT    DEFAULT NULL,
    `content`       TEXT    DEFAULT NULL,
    PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `phone` (
    `name`          TEXT    DEFAULT NULL,
    `hp`            TEXT    DEFAULT NULL,
    `th`            TEXT    DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
