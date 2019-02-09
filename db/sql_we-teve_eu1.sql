-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 09. Feb 2019 um 15:46
-- Server-Version: 10.1.37-MariaDB
-- PHP-Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `sql_we-teve_eu1`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `abo_db`
--

CREATE TABLE `abo_db` (
  `abo_id` int(11) NOT NULL,
  `abo_user_uuid` text NOT NULL COMMENT 'welcher abonniert wird',
  `user_uuid` text NOT NULL COMMENT 'der abonnent',
  `time` bigint(16) NOT NULL,
  `first_time` bigint(16) NOT NULL,
  `status` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `achievement_db`
--

CREATE TABLE `achievement_db` (
  `ach_id` int(11) NOT NULL,
  `uuid` text NOT NULL,
  `achievement` text NOT NULL,
  `achievement_data` text NOT NULL,
  `time` bigint(20) NOT NULL,
  `status` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `block_db`
--

CREATE TABLE `block_db` (
  `block_id` int(11) NOT NULL,
  `first_uuid` text NOT NULL,
  `second_uuid` text NOT NULL,
  `type` text NOT NULL,
  `time` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bookmark_db`
--

CREATE TABLE `bookmark_db` (
  `bm_id` int(11) NOT NULL,
  `uuid` text NOT NULL,
  `title` text NOT NULL,
  `url` text NOT NULL,
  `pos` int(11) NOT NULL,
  `status` text NOT NULL,
  `time` bigint(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `channel_design_db`
--

CREATE TABLE `channel_design_db` (
  `user_id` int(11) NOT NULL,
  `uuid` text NOT NULL,
  `img` text NOT NULL,
  `img_data` text NOT NULL,
  `video` text NOT NULL,
  `video_data` text NOT NULL,
  `videobeschreibung` text NOT NULL,
  `videobeschreibung_data` text NOT NULL,
  `diskussion` text NOT NULL,
  `diskussion_data` text NOT NULL,
  `abonnenten` text NOT NULL,
  `abonnenten_data` text NOT NULL,
  `info` text NOT NULL,
  `view_date` int(11) NOT NULL DEFAULT '1',
  `view_country` int(11) NOT NULL DEFAULT '1',
  `info_title_1` text NOT NULL,
  `info_text_1` text NOT NULL,
  `info_title_2` text NOT NULL,
  `info_text_2` text NOT NULL,
  `info_title_3` text NOT NULL,
  `info_text_3` text NOT NULL,
  `info_title_4` text NOT NULL,
  `info_text_4` text NOT NULL,
  `infofulltext` text NOT NULL,
  `info_full_text` text NOT NULL,
  `playlist` text NOT NULL,
  `playlist_data` text NOT NULL,
  `avatar_type` text NOT NULL,
  `background_type` text NOT NULL,
  `background_color` text NOT NULL,
  `nz1` text NOT NULL,
  `nz2` text NOT NULL,
  `nz3` text NOT NULL,
  `nz4` text NOT NULL,
  `nz5` text NOT NULL,
  `nz6` text NOT NULL,
  `nz7` text NOT NULL,
  `nz8` text NOT NULL,
  `nz9` text NOT NULL,
  `nz10` text NOT NULL,
  `nz11` text NOT NULL,
  `nz12` text NOT NULL,
  `nz13` text NOT NULL,
  `nz14` text NOT NULL,
  `nz15` text NOT NULL,
  `nz16` text NOT NULL,
  `nz17` text NOT NULL,
  `nz18` text NOT NULL,
  `nz19` text NOT NULL,
  `nz20` text NOT NULL,
  `nz21` text NOT NULL,
  `nz22` text NOT NULL,
  `nz23` text NOT NULL,
  `nz24` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `coinhive_stats_db`
--

CREATE TABLE `coinhive_stats_db` (
  `ch_id` int(11) NOT NULL,
  `ip` text NOT NULL,
  `uuid` text NOT NULL,
  `res` text NOT NULL,
  `device` text NOT NULL,
  `time` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `friend_db`
--

CREATE TABLE `friend_db` (
  `friend_id` int(11) NOT NULL,
  `first_uuid` text NOT NULL,
  `second_uuid` text NOT NULL,
  `status` text NOT NULL,
  `time` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `google_db`
--

CREATE TABLE `google_db` (
  `google_id` int(11) NOT NULL,
  `uuid` text NOT NULL,
  `g_channel_id` text NOT NULL,
  `status` text NOT NULL,
  `data` bigint(16) NOT NULL COMMENT 'added am'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kommentar_db`
--

CREATE TABLE `kommentar_db` (
  `kuid` varchar(12) NOT NULL,
  `vuid` text NOT NULL,
  `cuid` text NOT NULL,
  `re_kuid` text NOT NULL COMMENT 'Antwort auf',
  `uuid` text NOT NULL,
  `kommentar` text NOT NULL,
  `added_video` text NOT NULL COMMENT 'Videoantwort',
  `pos_vote` int(11) NOT NULL DEFAULT '0',
  `neg_vote` int(11) NOT NULL DEFAULT '0',
  `time` bigint(16) NOT NULL,
  `status` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kommentar_vote_db`
--

CREATE TABLE `kommentar_vote_db` (
  `vote_id` int(11) NOT NULL,
  `kuid` text NOT NULL,
  `uuid` text NOT NULL,
  `vote` text NOT NULL,
  `time` bigint(16) NOT NULL,
  `status` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `message_db`
--

CREATE TABLE `message_db` (
  `message_id` int(11) NOT NULL,
  `message_type` int(11) NOT NULL,
  `message_data` text NOT NULL,
  `message_data2` text NOT NULL,
  `uuid` text NOT NULL,
  `viewed` int(11) NOT NULL DEFAULT '0',
  `status` text NOT NULL,
  `time` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='später dann auch für direktnachrichten' ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `notification_db`
--

CREATE TABLE `notification_db` (
  `notification_id` int(11) NOT NULL,
  `notification_type` int(11) NOT NULL,
  `notification_data` text NOT NULL,
  `uuid` text NOT NULL,
  `viewed` int(11) NOT NULL DEFAULT '0',
  `time` bigint(16) NOT NULL,
  `status` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `notification_temp`
--

CREATE TABLE `notification_temp` (
  `not_temp_id` int(11) NOT NULL,
  `token` text NOT NULL,
  `uuid` text NOT NULL,
  `time` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `partner_db`
--

CREATE TABLE `partner_db` (
  `part_request_id` int(11) NOT NULL,
  `uuid` text NOT NULL,
  `methode` text NOT NULL,
  `payment_info` text NOT NULL,
  `payment_info2` text NOT NULL,
  `time` bigint(20) NOT NULL,
  `status` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `payments_db`
--

CREATE TABLE `payments_db` (
  `payment_id` int(11) NOT NULL,
  `uuid` text NOT NULL,
  `uuif` text NOT NULL,
  `month` bigint(20) NOT NULL,
  `paid_xmr` text NOT NULL,
  `paid` text NOT NULL,
  `payment_method` text NOT NULL,
  `payment_status` text NOT NULL,
  `time` bigint(20) NOT NULL,
  `status` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `playlist_content_db`
--

CREATE TABLE `playlist_content_db` (
  `pl_id` int(11) NOT NULL,
  `puid` text NOT NULL,
  `uuid` text NOT NULL,
  `vuid` text NOT NULL,
  `posi` int(11) NOT NULL COMMENT 'position',
  `added_at` bigint(16) NOT NULL,
  `uploaddate` bigint(16) NOT NULL,
  `status` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `playlist_db`
--

CREATE TABLE `playlist_db` (
  `puid` varchar(15) NOT NULL,
  `title` text NOT NULL,
  `uuid` text NOT NULL,
  `thumb` text NOT NULL,
  `notiz` text NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `orderby` int(11) NOT NULL DEFAULT '1',
  `privacy` int(11) NOT NULL DEFAULT '1',
  `last_interaction` bigint(16) NOT NULL DEFAULT '0',
  `time` bigint(16) NOT NULL,
  `status` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `recom_db`
--

CREATE TABLE `recom_db` (
  `recom_id` int(11) NOT NULL,
  `vuid` text NOT NULL,
  `from_uuid` text NOT NULL,
  `to_uuid` text NOT NULL,
  `status` text NOT NULL,
  `time` bigint(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `setting_db`
--

CREATE TABLE `setting_db` (
  `uuid` varchar(15) NOT NULL,
  `autoplay` int(11) NOT NULL DEFAULT '1',
  `design` int(11) NOT NULL DEFAULT '0',
  `last_name_update` bigint(20) NOT NULL DEFAULT '0',
  `last_update` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tmp_view_db`
--

CREATE TABLE `tmp_view_db` (
  `tmp_id` int(11) NOT NULL,
  `vuid` text NOT NULL,
  `user` text NOT NULL,
  `time` bigint(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `token_db`
--

CREATE TABLE `token_db` (
  `token` varchar(255) NOT NULL,
  `token_use` text NOT NULL,
  `user` text NOT NULL,
  `time_pause` bigint(16) NOT NULL,
  `next_use_time` bigint(16) NOT NULL,
  `time` bigint(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_db`
--

CREATE TABLE `user_db` (
  `uuid` varchar(255) NOT NULL,
  `uuif` text NOT NULL,
  `user` text NOT NULL,
  `user_name` text NOT NULL,
  `user_rang` text NOT NULL,
  `uuka` varchar(32) NOT NULL,
  `uukb` varchar(32) NOT NULL,
  `uukc` varchar(255) NOT NULL,
  `uukd` varchar(255) NOT NULL,
  `uuke` varchar(255) NOT NULL,
  `uukf` text NOT NULL,
  `email` text NOT NULL,
  `email_s` text NOT NULL,
  `emailcode` text NOT NULL,
  `email_verifier` int(1) NOT NULL DEFAULT '1',
  `failed_count` int(1) NOT NULL DEFAULT '0',
  `email_verified` int(1) NOT NULL DEFAULT '0',
  `ip` text NOT NULL,
  `host` text NOT NULL,
  `land` text NOT NULL,
  `sprache` text NOT NULL,
  `beitrit` text NOT NULL,
  `birthday` text NOT NULL,
  `abos` text NOT NULL,
  `friends` text NOT NULL,
  `max_friends` text NOT NULL,
  `xp` text NOT NULL,
  `level` text NOT NULL,
  `max_level` text NOT NULL,
  `vpw` text NOT NULL,
  `strikes` text NOT NULL,
  `blocked` text NOT NULL,
  `last_online_time` text NOT NULL,
  `coins` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_find_db`
--

CREATE TABLE `user_find_db` (
  `uuid` varchar(255) NOT NULL,
  `user_name` text NOT NULL,
  `user_name_s` text NOT NULL,
  `land` text NOT NULL,
  `xp` text NOT NULL,
  `abos` int(11) NOT NULL,
  `partner_status` int(11) NOT NULL DEFAULT '0',
  `online_status` text NOT NULL,
  `last_online_time` bigint(20) NOT NULL,
  `online_time` bigint(20) NOT NULL,
  `status` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `video_db`
--

CREATE TABLE `video_db` (
  `vuid` varchar(255) NOT NULL,
  `datavuid` text NOT NULL,
  `video_title` text NOT NULL,
  `uuid` text NOT NULL,
  `user_name` text NOT NULL COMMENT 'für die suche',
  `dauer` text NOT NULL,
  `views` bigint(255) NOT NULL,
  `max_result` text NOT NULL,
  `org_resolution` text NOT NULL,
  `render_status` text NOT NULL,
  `thumb` text NOT NULL,
  `info` text NOT NULL,
  `tags` text NOT NULL,
  `size` text NOT NULL,
  `color` text NOT NULL,
  `color2` text NOT NULL,
  `sprache` text NOT NULL,
  `kategorie` text NOT NULL,
  `pos_vote` int(11) NOT NULL,
  `neg_vote` int(11) NOT NULL,
  `ip` text NOT NULL,
  `host` text NOT NULL,
  `last_update` bigint(16) NOT NULL COMMENT 'wenn status = deleted, ist diese zahl + 30 tage die entgültige löschungszeit',
  `uploadstart` bigint(16) NOT NULL,
  `uploaddate` bigint(16) NOT NULL,
  `privacy` text NOT NULL,
  `status` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `video_vote_db`
--

CREATE TABLE `video_vote_db` (
  `vote_id` int(11) NOT NULL,
  `uuid` text NOT NULL,
  `vuid` text NOT NULL,
  `vote` text NOT NULL,
  `status` text NOT NULL,
  `time` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `xp_db`
--

CREATE TABLE `xp_db` (
  `xp_id` int(11) NOT NULL,
  `uuid` text NOT NULL,
  `action` text NOT NULL,
  `action_data` text NOT NULL,
  `xp` int(11) NOT NULL DEFAULT '0',
  `time` bigint(16) NOT NULL,
  `status` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `abo_db`
--
ALTER TABLE `abo_db`
  ADD PRIMARY KEY (`abo_id`);

--
-- Indizes für die Tabelle `achievement_db`
--
ALTER TABLE `achievement_db`
  ADD PRIMARY KEY (`ach_id`);

--
-- Indizes für die Tabelle `block_db`
--
ALTER TABLE `block_db`
  ADD PRIMARY KEY (`block_id`);

--
-- Indizes für die Tabelle `bookmark_db`
--
ALTER TABLE `bookmark_db`
  ADD PRIMARY KEY (`bm_id`);

--
-- Indizes für die Tabelle `channel_design_db`
--
ALTER TABLE `channel_design_db`
  ADD PRIMARY KEY (`user_id`);

--
-- Indizes für die Tabelle `coinhive_stats_db`
--
ALTER TABLE `coinhive_stats_db`
  ADD PRIMARY KEY (`ch_id`);

--
-- Indizes für die Tabelle `friend_db`
--
ALTER TABLE `friend_db`
  ADD PRIMARY KEY (`friend_id`);

--
-- Indizes für die Tabelle `google_db`
--
ALTER TABLE `google_db`
  ADD PRIMARY KEY (`google_id`);

--
-- Indizes für die Tabelle `kommentar_db`
--
ALTER TABLE `kommentar_db`
  ADD PRIMARY KEY (`kuid`);

--
-- Indizes für die Tabelle `kommentar_vote_db`
--
ALTER TABLE `kommentar_vote_db`
  ADD PRIMARY KEY (`vote_id`);

--
-- Indizes für die Tabelle `message_db`
--
ALTER TABLE `message_db`
  ADD PRIMARY KEY (`message_id`);

--
-- Indizes für die Tabelle `notification_db`
--
ALTER TABLE `notification_db`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indizes für die Tabelle `notification_temp`
--
ALTER TABLE `notification_temp`
  ADD PRIMARY KEY (`not_temp_id`);

--
-- Indizes für die Tabelle `partner_db`
--
ALTER TABLE `partner_db`
  ADD PRIMARY KEY (`part_request_id`);

--
-- Indizes für die Tabelle `payments_db`
--
ALTER TABLE `payments_db`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indizes für die Tabelle `playlist_content_db`
--
ALTER TABLE `playlist_content_db`
  ADD PRIMARY KEY (`pl_id`);

--
-- Indizes für die Tabelle `playlist_db`
--
ALTER TABLE `playlist_db`
  ADD PRIMARY KEY (`puid`);

--
-- Indizes für die Tabelle `recom_db`
--
ALTER TABLE `recom_db`
  ADD PRIMARY KEY (`recom_id`);

--
-- Indizes für die Tabelle `setting_db`
--
ALTER TABLE `setting_db`
  ADD PRIMARY KEY (`uuid`);

--
-- Indizes für die Tabelle `tmp_view_db`
--
ALTER TABLE `tmp_view_db`
  ADD PRIMARY KEY (`tmp_id`);

--
-- Indizes für die Tabelle `token_db`
--
ALTER TABLE `token_db`
  ADD PRIMARY KEY (`token`);

--
-- Indizes für die Tabelle `user_db`
--
ALTER TABLE `user_db`
  ADD PRIMARY KEY (`uuid`);

--
-- Indizes für die Tabelle `user_find_db`
--
ALTER TABLE `user_find_db`
  ADD PRIMARY KEY (`uuid`);

--
-- Indizes für die Tabelle `video_db`
--
ALTER TABLE `video_db`
  ADD PRIMARY KEY (`vuid`);

--
-- Indizes für die Tabelle `video_vote_db`
--
ALTER TABLE `video_vote_db`
  ADD PRIMARY KEY (`vote_id`);

--
-- Indizes für die Tabelle `xp_db`
--
ALTER TABLE `xp_db`
  ADD PRIMARY KEY (`xp_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `abo_db`
--
ALTER TABLE `abo_db`
  MODIFY `abo_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `achievement_db`
--
ALTER TABLE `achievement_db`
  MODIFY `ach_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `block_db`
--
ALTER TABLE `block_db`
  MODIFY `block_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `bookmark_db`
--
ALTER TABLE `bookmark_db`
  MODIFY `bm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `channel_design_db`
--
ALTER TABLE `channel_design_db`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `coinhive_stats_db`
--
ALTER TABLE `coinhive_stats_db`
  MODIFY `ch_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `friend_db`
--
ALTER TABLE `friend_db`
  MODIFY `friend_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `google_db`
--
ALTER TABLE `google_db`
  MODIFY `google_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `kommentar_vote_db`
--
ALTER TABLE `kommentar_vote_db`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `message_db`
--
ALTER TABLE `message_db`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `notification_db`
--
ALTER TABLE `notification_db`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `notification_temp`
--
ALTER TABLE `notification_temp`
  MODIFY `not_temp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `partner_db`
--
ALTER TABLE `partner_db`
  MODIFY `part_request_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `payments_db`
--
ALTER TABLE `payments_db`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `playlist_content_db`
--
ALTER TABLE `playlist_content_db`
  MODIFY `pl_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `recom_db`
--
ALTER TABLE `recom_db`
  MODIFY `recom_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tmp_view_db`
--
ALTER TABLE `tmp_view_db`
  MODIFY `tmp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `video_vote_db`
--
ALTER TABLE `video_vote_db`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `xp_db`
--
ALTER TABLE `xp_db`
  MODIFY `xp_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
