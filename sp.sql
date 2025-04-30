-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2025 at 06:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sp`
--

-- --------------------------------------------------------

--
-- Table structure for table `sp_carts`
--

CREATE TABLE `sp_carts` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_carts`
--

INSERT INTO `sp_carts` (`cart_id`, `user_id`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sp_cart_items`
--

CREATE TABLE `sp_cart_items` (
  `cart_item_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_classes`
--

CREATE TABLE `sp_classes` (
  `class_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_classes`
--

INSERT INTO `sp_classes` (`class_id`, `name`, `description`, `url`) VALUES
(1, 'Warrior', 'For as long as war has raged, heroes from every race have aimed to master the art of battle. Warriors combine strength, leadership, and a vast knowledge of arms and armor to wreak havoc in glorious combat.', 'https://wow.zamimg.com/images/wow/icons/large/classicon_warrior.jpg'),
(2, 'Hunter', 'From an early age, the call of the wild draws some adventurers from the comfort of their homes into the unforgiving primal world outside. Those who endure become Hunters.', 'https://wow.zamimg.com/images/wow/icons/large/classicon_hunter.jpg'),
(3, 'Druid', 'Druids harness the vast powers of nature to preserve balance and protect life. With experience, druids can unleash nature’s raw energy against their enemies, raining celestial fury on them from a great distance, binding them with enchanted vines, or ensna', 'https://wow.zamimg.com/images/wow/icons/large/classicon_druid.jpg'),
(4, 'Shaman', 'Shamans are spiritual guides and practitioners, not of the divine, but of the very elements. Unlike some other mystics, shamans commune with forces that are not strictly benevolent. The elements are chaotic, and left to their own devices, they rage agains', 'https://wow.zamimg.com/images/wow/icons/large/classicon_shaman.jpg'),
(5, 'Paladin', 'This is the call of the Paladin: to protect the weak, to bring justice to the unjust, and to vanquish evil from the darkest corners of the world.', 'https://wow.zamimg.com/images/wow/icons/large/classicon_paladin.jpg'),
(6, 'Priest', 'Priests are devoted to the spiritual, and express their unwavering faith by serving the people. For millennia they have left behind the confines of their temples and the comfort of their shrines so they can support their allies in war-torn lands.', 'https://wow.zamimg.com/images/wow/icons/large/classicon_priest.jpg'),
(7, 'Mage', 'Students gifted with a keen intellect and unwavering discipline may walk the path of the Mage. The arcane magic available to magi is both great and dangerous, and thus is revealed only to the most devoted practitioners.', 'https://wow.zamimg.com/images/wow/icons/large/classicon_mage.jpg'),
(8, 'Rogue', 'For Rogues, the only code is the contract, and their honor is purchased in gold. Free from the constraints of a conscience, these mercenaries rely on brutal and efficient tactics.', 'https://wow.zamimg.com/images/wow/icons/large/classicon_rogue.jpg'),
(9, 'Warlock', 'In the face of demonic power, most heroes see death. Warlocks see only opportunity. Dominance is their aim, and they have found a path to it in the dark arts. These voracious spellcasters summon demonic minions to fight beside them.', 'https://wow.zamimg.com/images/wow/icons/large/classicon_warlock.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sp_orders`
--

CREATE TABLE `sp_orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_orders`
--

INSERT INTO `sp_orders` (`order_id`, `user_id`, `order_date`, `status`) VALUES
(63, 1, '2025-04-22', 'confirmed'),
(67, 1, '2025-04-23', 'confirmed'),
(68, 2, '2025-04-23', 'confirmed'),
(69, 1, '2025-04-23', 'confirmed'),
(70, 2, '2025-04-23', 'shipped'),
(71, 2, '2025-04-23', 'cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `sp_order_items`
--

CREATE TABLE `sp_order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_order_items`
--

INSERT INTO `sp_order_items` (`order_item_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(73, 63, 10020, 2, 175),
(75, 63, 10039, 1, 57),
(76, 63, 10090, 1, 61),
(77, 63, 10138, 1, 411),
(78, 63, 10094, 1, 26),
(79, 63, 10000, 1, 22),
(80, 63, 10069, 1, 14),
(81, 63, 10130, 1, 19),
(82, 63, 10132, 1, 62),
(83, 63, 20036, 1, 140),
(84, 63, 20092, 1, 253),
(85, 63, 20100, 1, 12),
(94, 67, 10086, 1, 74),
(95, 67, 10152, 1, 27),
(96, 67, 20032, 1, 267),
(97, 67, 30054, 1, 50),
(98, 67, 20105, 1, 164),
(99, 68, 10094, 1, 26),
(100, 68, 20091, 2, 29),
(101, 68, 10020, 1, 175),
(102, 68, 10129, 1, 167),
(103, 68, 20018, 1, 72),
(104, 68, 10152, 1, 27),
(105, 68, 20032, 1, 267),
(106, 69, 10152, 1, 27),
(107, 69, 10086, 1, 74),
(108, 69, 30054, 1, 50),
(109, 69, 20105, 1, 164),
(110, 70, 10039, 1, 57),
(111, 70, 20032, 1, 267),
(112, 70, 30054, 1, 50),
(113, 71, 20105, 1, 164);

-- --------------------------------------------------------

--
-- Table structure for table `sp_privileges`
--

CREATE TABLE `sp_privileges` (
  `privilege_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_privileges`
--

INSERT INTO `sp_privileges` (`privilege_id`, `name`) VALUES
(1, 'user'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `sp_products`
--

CREATE TABLE `sp_products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `rarity` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `class_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_products`
--

INSERT INTO `sp_products` (`product_id`, `name`, `price`, `rarity`, `url`, `class_id`, `type_id`, `description`) VALUES
(10000, 'Claymore of Burning Legion', 22, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_ambush.jpg', 5, 7, 'A simple claymore used by wanderers near Burning Legion.'),
(10001, 'Claymore of Broken Isles', 19, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_backstab.jpg', 4, 7, 'A simple claymore used by wanderers near Broken Isles.'),
(10002, 'Dreadwoven Trousers of Necrolords', 350, 'legendary', 'https://wow.zamimg.com/images/wow/icons/large/ability_creature_cursed_04.jpg', 4, 5, '‘A soulbound artifact from the heart of Necrolords.’'),
(10003, 'Wyrmbound Pauldrons of Orgrimmar', 109, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/ability_creature_poison_04.jpg', 3, 2, 'A battle-worn relic tied to the legends of Orgrimmar.'),
(10005, 'Felforged Rod of Scarlet Crusade', 334, 'legendary', 'https://wow.zamimg.com/images/wow/icons/large/ability_dualwield.jpg', 7, 8, '‘A soulbound artifact from the heart of Scarlet Crusade.’'),
(10015, 'Treads of Undercity', 22, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_hunter_pet_wolf.jpg', 4, 6, 'A simple treads used by wanderers near Undercity.'),
(10016, 'Wyrmbound Greaves of The Night Fae', 118, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/ability_mage_conjurefoodrank9.jpg', 6, 6, 'A battle-worn relic tied to the legends of The Night Fae.'),
(10017, 'Robes of Dreadmaul', 23, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_mage_netherwindpresence.jpg', 5, 3, 'A simple robes used by wanderers near Dreadmaul.'),
(10018, 'Wyrmbound Gloves of Blackrock', 191, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/ability_mount_blackdirewolf.jpg', 3, 4, 'A battle-worn relic tied to the legends of Blackrock.'),
(10019, 'Spaulders of Necrolords', 11, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_mount_blackpanther.jpg', 5, 2, 'A simple spaulders used by wanderers near Necrolords.'),
(10020, 'Wyrmbound Helm of Bastion', 175, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/ability_mount_dreadsteed.jpg', 5, 1, 'A battle-worn relic tied to the legends of Bastion.'),
(10034, 'Branch of Undercity', 21, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_poisonsting.jpg', 6, 8, 'A simple branch used by wanderers near Undercity.'),
(10035, 'Leggings of Boralus', 17, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_rogue_disguise.jpg', 5, 5, 'A simple leggings used by wanderers near Boralus.'),
(10036, 'Runed Sword of Scarlet Crusade', 75, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/ability_rogue_dualweild.jpg', 1, 7, 'Recovered from an outpost near Scarlet Crusade during a regional skirmish.'),
(10037, 'Wyrmbound Leggings of Blackrock', 149, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/ability_rogue_rupture.jpg', 7, 5, 'A battle-worn relic tied to the legends of Blackrock.'),
(10038, 'Pauldrons of Maldraxxus', 20, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_smash.jpg', 7, 2, 'A simple pauldrons used by wanderers near Maldraxxus.'),
(10039, 'Hardened Mask of Ashenvale', 57, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/ability_spy.jpg', 1, 1, 'Recovered from an outpost near Ashenvale during a regional skirmish.'),
(10040, 'Mystic Helm of Gnomeregan', 68, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/ability_thunderbolt.jpg', 4, 1, 'Recovered from an outpost near Gnomeregan during a regional skirmish.'),
(10041, 'Moonlit Trousers of Felwood', 184, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/ability_upgrademoonglaive.jpg', 3, 5, 'A battle-worn relic tied to the legends of Felwood.'),
(10045, 'Stormforged Blade of Torghast', 161, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/ability_warrior_warcry.jpg', 4, 7, 'A battle-worn relic tied to the legends of Torghast.'),
(10046, 'Grips of Zandalar', 19, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_whirlwind.jpg', 7, 4, 'A simple grips used by wanderers near Zandalar.'),
(10047, 'Ashen Crown of Burning Legion', 476, 'legendary', 'https://wow.zamimg.com/images/wow/icons/large/achievement_boss_fourhorsemen.jpg', 4, 1, '‘A soulbound artifact from the heart of Burning Legion.’'),
(10048, 'Mystic Grips of Boralus', 65, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/achievement_dungeon_cotstratholme.jpg', 3, 4, 'Recovered from an outpost near Boralus during a regional skirmish.'),
(10049, 'Stormforged Gauntlets of Burning Legion', 141, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/achievement_dungeon_naxxramas.jpg', 4, 4, 'A battle-worn relic tied to the legends of Burning Legion.'),
(10050, 'Armor of Broken Isles', 26, 'common', 'https://wow.zamimg.com/images/wow/icons/large/achievement_reputation_argentchampion.jpg', 6, 3, 'A simple armor used by wanderers near Broken Isles.'),
(10051, 'Moonlit Greaves of Boralus', 193, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/achievement_reputation_argentcrusader.jpg', 3, 6, 'A battle-worn relic tied to the legends of Boralus.'),
(10052, 'Runed Armor of Drakkari', 44, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/achievement_zone_elwynnforest.jpg', 7, 3, 'Recovered from an outpost near Drakkari during a regional skirmish.'),
(10053, 'Mystic Mask of Stormwind', 77, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/classic_ability_druid_demoralizingroar.jpg', 8, 1, 'Recovered from an outpost near Stormwind during a regional skirmish.'),
(10054, 'Gloves of Necrolords', 19, 'common', 'https://wow.zamimg.com/images/wow/icons/large/classic_inv_sword_59.jpg', 3, 4, 'A simple gloves used by wanderers near Necrolords.'),
(10055, 'Mystic Visage of Broken Isles', 72, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/classic_spell_fire_elementaldevastation.jpg', 3, 1, 'Recovered from an outpost near Broken Isles during a regional skirmish.'),
(10056, 'Stormforged Rod of Blackrock', 173, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/classic_spell_holy_blessingofprotection.jpg', 8, 8, 'A battle-worn relic tied to the legends of Blackrock.'),
(10058, 'Runed Helm of Necrolords', 43, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_alchemy_elixir_03.jpg', 6, 1, 'Recovered from an outpost near Necrolords during a regional skirmish.'),
(10059, 'Dreadwoven Handwraps of Zandalar', 438, 'legendary', 'https://wow.zamimg.com/images/wow/icons/large/inv_alchemy_endlessflask_03.jpg', 1, 4, '‘A soulbound artifact from the heart of Zandalar.’'),
(10060, 'Moonlit Boots of Orgrimmar', 159, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/inv_alchemy_endlessflask_06.jpg', 8, 6, 'A battle-worn relic tied to the legends of Orgrimmar.'),
(10061, 'Stormforged Legplates of Maldraxxus', 198, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/inv_alchemy_potion_06.jpg', 7, 5, 'A battle-worn relic tied to the legends of Maldraxxus.'),
(10062, 'Mystic Shoulders of Kul Tiras', 65, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_ammo_arrow_01.jpg', 7, 2, 'Recovered from an outpost near Kul Tiras during a regional skirmish.'),
(10063, 'Ashen Handwraps of Broken Isles', 479, 'legendary', 'https://wow.zamimg.com/images/wow/icons/large/inv_ammo_bullet_04.jpg', 4, 4, '‘A soulbound artifact from the heart of Broken Isles.’'),
(10064, 'Runed Sabatons of Bastion', 53, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_axe_02.jpg', 5, 6, 'Recovered from an outpost near Bastion during a regional skirmish.'),
(10065, 'Legplates of Blackrock', 29, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_axe_04.jpg', 7, 5, 'A simple legplates used by wanderers near Blackrock.'),
(10069, 'Claymore of Dalaran', 14, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_axe_13.jpg', 5, 7, 'A simple claymore used by wanderers near Dalaran.'),
(10070, 'Ashen Chestplate of Thunder Bluff', 485, 'legendary', 'https://wow.zamimg.com/images/wow/icons/large/inv_axe_14.jpg', 2, 3, '‘A soulbound artifact from the heart of Thunder Bluff.’'),
(10071, 'Blade of Revendreth', 19, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_axe_16.jpg', 4, 7, 'A simple blade used by wanderers near Revendreth.'),
(10072, 'Staff of Dreadmaul', 19, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_axe_17.jpg', 7, 8, 'A simple staff used by wanderers near Dreadmaul.'),
(10073, 'Chestplate of Kul Tiras', 11, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_axe_21.jpg', 1, 3, 'A simple chestplate used by wanderers near Kul Tiras.'),
(10074, 'Armor of The Void', 19, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_banner_03.jpg', 5, 3, 'A simple armor used by wanderers near The Void.'),
(10078, 'Moonlit Blade of Wyrmrest', 108, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/inv_belt_04.jpg', 1, 7, 'A battle-worn relic tied to the legends of Wyrmrest.'),
(10079, 'Hardened Handwraps of Wyrmrest', 75, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_belt_12.jpg', 1, 4, 'Recovered from an outpost near Wyrmrest during a regional skirmish.'),
(10080, 'Claymore of Boralus', 12, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_belt_17.jpg', 1, 7, 'A simple claymore used by wanderers near Boralus.'),
(10084, 'Ashen Leggings of Maldraxxus', 391, 'legendary', 'https://wow.zamimg.com/images/wow/icons/large/inv_belt_27.jpg', 1, 5, '‘A soulbound artifact from the heart of Maldraxxus.’'),
(10085, 'Grips of Torghast', 14, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_belt_28.jpg', 1, 4, 'A simple grips used by wanderers near Torghast.'),
(10086, 'Mystic Mask of Stormwind 571', 74, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_belt_29.jpg', 1, 1, 'Recovered from an outpost near Stormwind during a regional skirmish.'),
(10090, 'Hardened Mask of Drakkari', 61, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_belt_39.jpg', 7, 1, 'Recovered from an outpost near Drakkari during a regional skirmish.'),
(10091, 'Mystic Treads of Shadowlands', 76, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_belt_43c.jpg', 1, 6, 'Recovered from an outpost near Shadowlands during a regional skirmish.'),
(10092, 'Ashen Armor of Thunder Bluff', 253, 'legendary', 'https://wow.zamimg.com/images/wow/icons/large/inv_bijou_bronze.jpg', 1, 3, '‘A soulbound artifact from the heart of Thunder Bluff.’'),
(10093, 'Hardened Trousers of The Night Fae', 54, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_bijou_purple.jpg', 5, 5, 'Recovered from an outpost near The Night Fae during a regional skirmish.'),
(10094, 'Visage of Dalaran', 26, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_boots_02.jpg', 4, 1, 'A simple visage used by wanderers near Dalaran.'),
(10095, 'Mystic Mask of Dalaran', 58, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_boots_05.jpg', 6, 1, 'Recovered from an outpost near Dalaran during a regional skirmish.'),
(10096, 'Ring of Ashenvale', 24, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_boots_chain_04.jpg', 8, 10, 'A simple ring used by wanderers near Ashenvale.'),
(10097, 'Trousers of Blackrock', 12, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_boots_cloth_03.jpg', 4, 5, 'A simple trousers used by wanderers near Blackrock.'),
(10098, 'Crown of Naxxramas', 25, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_boots_cloth_07.jpg', 8, 1, 'A simple crown used by wanderers near Naxxramas.'),
(10108, 'Ashen Talisman of Undercity', 256, 'legendary', 'https://wow.zamimg.com/images/wow/icons/large/inv_box_02.jpg', 5, 10, '‘A soulbound artifact from the heart of Undercity.’'),
(10110, 'Runed Sabatons of Torghast', 58, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_box_04.jpg', 8, 6, 'Recovered from an outpost near Torghast during a regional skirmish.'),
(10114, 'Stormforged Spaulders of Silvermoon', 151, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/inv_bracer_10.jpg', 7, 2, 'A battle-worn relic tied to the legends of Silvermoon.'),
(10115, 'Hardened Vest of Ashenvale', 42, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_bracer_16.jpg', 4, 3, 'Recovered from an outpost near Ashenvale during a regional skirmish.'),
(10116, 'Hardened Band of Wyrmrest', 52, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_bracer_18.jpg', 2, 10, 'Recovered from an outpost near Wyrmrest during a regional skirmish.'),
(10123, 'Bow of Necrolords', 15, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_chain_07.jpg', 3, 9, 'A simple bow used by wanderers near Necrolords.'),
(10124, 'Stormforged Armor of The Maw', 143, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_chain_10.jpg', 5, 3, 'A battle-worn relic tied to the legends of The Maw.'),
(10125, 'Stormforged Blade of Undercity', 154, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_chain_13.jpg', 1, 7, 'A battle-worn relic tied to the legends of Undercity.'),
(10129, 'Stormforged Mask of Dreadmaul', 167, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_cloth_08.jpg', 5, 1, 'A battle-worn relic tied to the legends of Dreadmaul.'),
(10130, 'Claymore of Burning Legion 297', 19, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_cloth_10.jpg', 5, 7, 'A simple claymore used by wanderers near Burning Legion.'),
(10131, 'Ashen Visage of Boralus', 278, 'legendary', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_cloth_12.jpg', 6, 1, '‘A soulbound artifact from the heart of Boralus.’'),
(10132, 'Runed Sword of Drakkari', 62, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_cloth_14.jpg', 5, 7, 'Recovered from an outpost near Drakkari during a regional skirmish.'),
(10133, 'Greaves of Thunder Bluff', 30, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_cloth_23.jpg', 2, 6, 'A simple greaves used by wanderers near Thunder Bluff.'),
(10134, 'Seal of Blackrock', 20, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_cloth_25.jpg', 7, 10, 'A simple seal used by wanderers near Blackrock.'),
(10138, 'Felforged Mask of Shadowlands', 411, 'legendary', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_leather_04.jpg', 3, 1, '‘A soulbound artifact from the heart of Shadowlands.’'),
(10139, 'Crossbow of Shadowlands', 19, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_leather_07.jpg', 3, 9, 'A simple crossbow used by wanderers near Shadowlands.'),
(10140, 'Mystic Mask of Ashenvale', 77, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_leather_08.jpg', 7, 1, 'Recovered from an outpost near Ashenvale during a regional skirmish.'),
(10144, 'Ashen Chestplate of Scarlet Crusade', 394, 'legendary', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_plate08.jpg', 3, 3, '‘A soulbound artifact from the heart of Scarlet Crusade.’'),
(10145, 'Gauntlets of Scarlet Crusade', 23, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_plate11.jpg', 4, 4, 'A simple gauntlets used by wanderers near Scarlet Crusade.'),
(10146, 'Runed Staff of Silvermoon', 53, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_plate13.jpg', 8, 8, 'Recovered from an outpost near Silvermoon during a regional skirmish.'),
(10147, 'Stormforged Grips of Zandalar', 119, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_plate15.jpg', 2, 4, 'A battle-worn relic tied to the legends of Zandalar.'),
(10148, 'Wyrmbound Grips of The Maw', 126, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_plate16.jpg', 3, 4, 'A battle-worn relic tied to the legends of The Maw.'),
(10149, 'Mask of Boralus', 20, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_plate_23.jpg', 8, 1, 'A simple mask used by wanderers near Boralus.'),
(10150, 'Treads of Naxxramas', 16, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_crate_01.jpg', 1, 6, 'A simple treads used by wanderers near Naxxramas.'),
(10151, 'Mystic Staff of Kyrian', 75, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_crate_03.jpg', 6, 8, 'Recovered from an outpost near Kyrian during a regional skirmish.'),
(10152, 'Mask of Dalaran', 27, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_crate_04.jpg', 1, 1, 'A simple mask used by wanderers near Dalaran.'),
(20000, 'Kilt of Zandalar', 14, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_ambush.jpg', 1, 5, 'Simple kilt worn near Zandalar.'),
(20001, 'Eternal Grips of Ashenvale', 417, 'legendary', 'https://wow.zamimg.com/images/wow/icons/large/ability_backstab.jpg', 2, 4, '‘Once held by the champions of Ashenvale in the War of Shadows.’'),
(20002, 'Lightwoven Treads of Silvermoon', 328, 'legendary', 'https://wow.zamimg.com/images/wow/icons/large/ability_creature_cursed_04.jpg', 3, 6, '‘Once held by the champions of Silvermoon in the War of Shadows.’'),
(20006, 'Tunic of Broken Isles', 25, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_eyeoftheowl.jpg', 7, 3, 'Simple tunic worn near Broken Isles.'),
(20007, 'Staff of Stormwind', 20, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_golemthunderclap.jpg', 8, 8, 'Simple staff worn near Stormwind.'),
(20008, 'Mantle of Drakkari', 30, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_gouge.jpg', 1, 2, 'Simple mantle worn near Drakkari.'),
(20012, 'Charged Treads of Broken Isles', 56, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/ability_hunter_pet_bear.jpg', 5, 6, 'Recovered from ruins left by the fall of Broken Isles.'),
(20013, 'Chestplate of The Maw', 13, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_hunter_pet_gorilla.jpg', 6, 3, 'Simple chestplate worn near The Maw.'),
(20014, 'Charged Mask of Undercity', 52, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/ability_hunter_pet_owl.jpg', 7, 1, 'Recovered from ruins left by the fall of Undercity.'),
(20015, 'Treads of Stormwind', 30, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_hunter_pet_wolf.jpg', 8, 6, 'Simple treads worn near Stormwind.'),
(20016, 'Ashen Sabatons of Scarlet Crusade', 170, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/ability_mage_conjurefoodrank9.jpg', 1, 6, 'Forged in the fires of Scarlet Crusade during the great conflict.'),
(20017, 'Charged Boots of Kyrian', 64, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/ability_mage_netherwindpresence.jpg', 2, 6, 'Recovered from ruins left by the fall of Kyrian.'),
(20018, 'Blessed Visage of Drakkari', 72, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/ability_mount_blackdirewolf.jpg', 3, 1, 'Recovered from ruins left by the fall of Drakkari.'),
(20019, 'Ashen Gloves of Boralus', 116, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/ability_mount_blackpanther.jpg', 4, 4, 'Forged in the fires of Boralus during the great conflict.'),
(20020, 'Chestplate of Broken Isles', 12, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_mount_dreadsteed.jpg', 5, 3, 'Simple chestplate worn near Broken Isles.'),
(20021, 'Staff of Naxxramas', 16, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_mount_jungletiger.jpg', 6, 8, 'Simple staff worn near Naxxramas.'),
(20022, 'Blessed Grips of Kyrian', 65, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/ability_mount_kodo_03.jpg', 7, 4, 'Recovered from ruins left by the fall of Kyrian.'),
(20023, 'Band of Scarlet Crusade', 13, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_mount_mechastrider.jpg', 8, 10, 'Simple band worn near Scarlet Crusade.'),
(20024, 'Handwraps of Boralus', 17, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_mount_mountainram.jpg', 1, 4, 'Simple handwraps worn near Boralus.'),
(20025, 'Wyrmforged Staff of Bastion', 151, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/ability_mount_nightmarehorse.jpg', 2, 8, 'Forged in the fires of Bastion during the great conflict.'),
(20026, 'Pauldrons of Felwood', 23, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_mount_raptor.jpg', 3, 2, 'Simple pauldrons worn near Felwood.'),
(20028, 'Blessed Spaulders of Maldraxxus', 65, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/ability_mount_undeadhorse.jpg', 5, 2, 'Recovered from ruins left by the fall of Maldraxxus.'),
(20029, 'Wyrmforged Visage of Shadowlands', 174, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/ability_mount_whitetiger.jpg', 6, 1, 'Forged in the fires of Shadowlands during the great conflict.'),
(20030, 'Runed Band of Blackrock', 53, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/ability_paladin_blessedhands.jpg', 7, 10, 'Recovered from ruins left by the fall of Blackrock.'),
(20031, 'Eternal Gauntlets of Silvermoon', 449, 'legendary', 'https://wow.zamimg.com/images/wow/icons/large/ability_paladin_hammeroftherighteous.jpg', 8, 4, '‘Once held by the champions of Silvermoon in the War of Shadows.’'),
(20032, 'Eternal Crown of Scarlet Crusade', 267, 'legendary', 'https://wow.zamimg.com/images/wow/icons/large/ability_paladin_sheathoflight.jpg', 1, 1, '‘Once held by the champions of Scarlet Crusade in the War of Shadows.’'),
(20036, 'Ashen Sword of Broken Isles', 140, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/ability_rogue_dualweild.jpg', 5, 7, 'Forged in the fires of Broken Isles during the great conflict.'),
(20037, 'Wyrmforged Greaves of Kyrian', 125, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/ability_rogue_rupture.jpg', 6, 6, 'Forged in the fires of Kyrian during the great conflict.'),
(20038, 'Legplates of Naxxramas', 16, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_smash.jpg', 7, 5, 'Simple legplates worn near Naxxramas.'),
(20042, 'Charged Handwraps of Bastion', 72, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/ability_warlock_improvedsoulleech.jpg', 3, 4, 'Recovered from ruins left by the fall of Bastion.'),
(20043, 'Sabatons of Drakkari', 16, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_warlock_incubus.jpg', 4, 6, 'Simple sabatons worn near Drakkari.'),
(20044, 'Handwraps of Felwood', 12, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_warrior_sunder.jpg', 5, 4, 'Simple handwraps worn near Felwood.'),
(20048, 'Ashen Robes of Felwood', 175, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/achievement_dungeon_cotstratholme.jpg', 1, 3, 'Forged in the fires of Felwood during the great conflict.'),
(20049, 'Blessed Chestplate of Undercity', 78, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/achievement_dungeon_naxxramas.jpg', 2, 3, 'Recovered from ruins left by the fall of Undercity.'),
(20050, 'Legplates of Ashenvale', 22, 'common', 'https://wow.zamimg.com/images/wow/icons/large/achievement_reputation_argentchampion.jpg', 3, 5, 'Simple legplates worn near Ashenvale.'),
(20051, 'Stormveiled Gloves of Shadowlands', 101, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/achievement_reputation_argentcrusader.jpg', 4, 4, 'Forged in the fires of Shadowlands during the great conflict.'),
(20052, 'Stormveiled Sigil of Broken Isles', 155, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/achievement_zone_elwynnforest.jpg', 5, 10, 'Forged in the fires of Broken Isles during the great conflict.'),
(20053, 'Mask of Kul Tiras', 22, 'common', 'https://wow.zamimg.com/images/wow/icons/large/classic_ability_druid_demoralizingroar.jpg', 6, 1, 'Simple mask worn near Kul Tiras.'),
(20054, 'Rod of Broken Isles', 22, 'common', 'https://wow.zamimg.com/images/wow/icons/large/classic_inv_sword_59.jpg', 7, 8, 'Simple rod worn near Broken Isles.'),
(20055, 'Stormveiled Rod of Silvermoon', 189, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/classic_spell_fire_elementaldevastation.jpg', 8, 8, 'Forged in the fires of Silvermoon during the great conflict.'),
(20056, 'Charged Sabatons of Felwood', 76, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/classic_spell_holy_blessingofprotection.jpg', 1, 6, 'Recovered from ruins left by the fall of Felwood.'),
(20057, 'Ashen Sabatons of Felwood', 183, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/inv_10_fishing_dragonislescoins_gold.jpg', 2, 6, 'Forged in the fires of Felwood during the great conflict.'),
(20058, 'Dreadforged Treads of Orgrimmar', 410, 'legendary', 'https://wow.zamimg.com/images/wow/icons/large/inv_alchemy_elixir_03.jpg', 3, 6, '‘Once held by the champions of Orgrimmar in the War of Shadows.’'),
(20059, 'Greaves of Felwood', 23, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_alchemy_endlessflask_03.jpg', 4, 6, 'Simple greaves worn near Felwood.'),
(20063, 'Blessed Gloves of Naxxramas', 72, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_ammo_bullet_04.jpg', 8, 4, 'Recovered from ruins left by the fall of Naxxramas.'),
(20064, 'Stormveiled Vest of Kul Tiras', 162, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/inv_axe_02.jpg', 1, 3, 'Forged in the fires of Kul Tiras during the great conflict.'),
(20065, 'Band of Boralus', 28, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_axe_04.jpg', 2, 10, 'Simple band worn near Boralus.'),
(20066, 'Stormveiled Leggings of Zandalar', 126, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/inv_axe_05.jpg', 3, 5, 'Forged in the fires of Zandalar during the great conflict.'),
(20067, 'Wyrmforged Handwraps of Dragon Isles', 162, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/inv_axe_10.jpg', 4, 4, 'Forged in the fires of Dragon Isles during the great conflict.'),
(20068, 'Sigil of Dragon Isles', 24, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_axe_12.jpg', 5, 10, 'Simple sigil worn near Dragon Isles.'),
(20075, 'Lightwoven Leggings of The Void', 496, 'legendary', 'https://wow.zamimg.com/images/wow/icons/large/inv_bannerpvp_01.jpg', 4, 5, '‘Once held by the champions of The Void in the War of Shadows.’'),
(20076, 'Stormveiled Armor of Maldraxxus', 189, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/inv_battery_02.jpg', 5, 3, 'Forged in the fires of Maldraxxus during the great conflict.'),
(20077, 'Gloves of Torghast', 14, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_belt_03.jpg', 6, 4, 'Simple gloves worn near Torghast.'),
(20078, 'Charged Gloves of Undercity', 68, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_belt_04.jpg', 7, 4, 'Recovered from ruins left by the fall of Undercity.'),
(20079, 'Charged Staff of Undercity', 60, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_belt_12.jpg', 8, 8, 'Recovered from ruins left by the fall of Undercity.'),
(20080, 'Charged Gauntlets of Drakkari', 47, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_belt_17.jpg', 1, 4, 'Recovered from ruins left by the fall of Drakkari.'),
(20084, 'Runed Chestplate of Naxxramas', 69, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_belt_27.jpg', 5, 3, 'Recovered from ruins left by the fall of Naxxramas.'),
(20085, 'Wyrmforged Handwraps of Maldraxxus', 193, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/inv_belt_28.jpg', 6, 4, 'Forged in the fires of Maldraxxus during the great conflict.'),
(20086, 'Blessed Staff of Felwood', 78, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_belt_29.jpg', 7, 8, 'Recovered from ruins left by the fall of Felwood.'),
(20087, 'Charged Visage of Gnomeregan', 58, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_belt_34.jpg', 8, 1, 'Recovered from ruins left by the fall of Gnomeregan.'),
(20088, 'Blessed Shoulders of Wyrmrest', 64, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_belt_38b.jpg', 1, 2, 'Recovered from ruins left by the fall of Wyrmrest.'),
(20089, 'Wyrmforged Greaves of Dreadmaul', 164, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/inv_belt_38c.jpg', 2, 6, 'Forged in the fires of Dreadmaul during the great conflict.'),
(20090, 'Blessed Visage of Ashenvale', 50, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_belt_39.jpg', 3, 1, 'Recovered from ruins left by the fall of Ashenvale.'),
(20091, 'Crown of Broken Isles', 29, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_belt_43c.jpg', 4, 1, 'Simple crown worn near Broken Isles.'),
(20092, 'Lightwoven Sword of Drakkari', 253, 'legendary', 'https://wow.zamimg.com/images/wow/icons/large/inv_bijou_bronze.jpg', 5, 7, '‘Once held by the champions of Drakkari in the War of Shadows.’'),
(20093, 'Gloves of Orgrimmar', 25, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_bijou_purple.jpg', 6, 4, 'Simple gloves worn near Orgrimmar.'),
(20094, 'Stormveiled Branch of Drakkari', 135, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/inv_boots_02.jpg', 7, 8, 'Forged in the fires of Drakkari during the great conflict.'),
(20095, 'Treads of Kul Tiras', 24, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_boots_05.jpg', 8, 6, 'Simple treads worn near Kul Tiras.'),
(20096, 'Wyrmforged Claymore of The Maw', 161, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/inv_boots_chain_04.jpg', 1, 7, 'Forged in the fires of The Maw during the great conflict.'),
(20097, 'Band of Bastion', 24, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_boots_cloth_03.jpg', 2, 10, 'Simple band worn near Bastion.'),
(20098, 'Chestplate of Necrolords', 19, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_boots_cloth_07.jpg', 3, 3, 'Simple chestplate worn near Necrolords.'),
(20099, 'Charged Gloves of Dragon Isles', 65, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_boots_cloth_09.jpg', 4, 4, 'Recovered from ruins left by the fall of Dragon Isles.'),
(20100, 'Blade of Zandalar', 12, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_boots_plate_01.jpg', 5, 7, 'Simple blade worn near Zandalar.'),
(20101, 'Charged Sabatons of Burning Legion', 62, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_boots_plate_02.jpg', 6, 6, 'Recovered from ruins left by the fall of Burning Legion.'),
(20102, 'Shoulders of The Maw', 21, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_boots_plate_03.jpg', 7, 2, 'Simple shoulders worn near The Maw.'),
(20103, 'Ashen Mask of Naxxramas', 182, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/inv_boots_plate_05.jpg', 8, 1, 'Forged in the fires of Naxxramas during the great conflict.'),
(20104, 'Blessed Robes of Kyrian', 69, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_boots_plate_06.jpg', 1, 3, 'Recovered from ruins left by the fall of Kyrian.'),
(20105, 'Ashen Mask of Shadowlands', 164, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/inv_boots_plate_07.jpg', 2, 1, 'Forged in the fires of Shadowlands during the great conflict.'),
(20106, 'Armor of Kul Tiras', 14, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_boots_plate_09.jpg', 3, 3, 'Simple armor worn near Kul Tiras.'),
(20107, 'Blessed Armor of Dreadmaul', 79, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_box_01.jpg', 4, 3, 'Recovered from ruins left by the fall of Dreadmaul.'),
(20111, 'Gloves of Bastion', 11, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_bracer_01.jpg', 8, 4, 'Simple gloves worn near Bastion.'),
(20112, 'Blessed Kilt of The Maw', 41, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_bracer_03.jpg', 1, 5, 'Recovered from ruins left by the fall of The Maw.'),
(20113, 'Eternal Armor of Maldraxxus', 343, 'legendary', 'https://wow.zamimg.com/images/wow/icons/large/inv_bracer_09.jpg', 2, 3, '‘Once held by the champions of Maldraxxus in the War of Shadows.’'),
(20114, 'Pauldrons of Gnomeregan', 29, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_bracer_10.jpg', 3, 2, 'Simple pauldrons worn near Gnomeregan.'),
(20115, 'Claymore of Torghast', 14, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_bracer_16.jpg', 4, 7, 'Simple claymore worn near Torghast.'),
(20116, 'Handwraps of Naxxramas', 10, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_bracer_18.jpg', 5, 4, 'Simple handwraps worn near Naxxramas.'),
(20120, 'Blessed Leggings of Burning Legion', 66, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_cask_01.jpg', 1, 5, 'Recovered from ruins left by the fall of Burning Legion.'),
(20121, 'Dreadforged Seal of Silvermoon', 471, 'legendary', 'https://wow.zamimg.com/images/wow/icons/large/inv_cask_02.jpg', 2, 10, '‘Once held by the champions of Silvermoon in the War of Shadows.’'),
(20126, 'Charged Mask of Gnomeregan', 74, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_chain_15.jpg', 7, 1, 'Recovered from ruins left by the fall of Gnomeregan.'),
(20127, 'Boots of The Void', 13, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_cloth_03.jpg', 8, 6, 'Simple boots worn near The Void.'),
(20128, 'Lightwoven Greaves of Gnomeregan', 463, 'legendary', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_cloth_04.jpg', 1, 6, '‘Once held by the champions of Gnomeregan in the War of Shadows.’'),
(20129, 'Armor of Gnomeregan', 23, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_cloth_08.jpg', 2, 3, 'Simple armor worn near Gnomeregan.'),
(20130, 'Pauldrons of Shadowlands', 19, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_cloth_10.jpg', 3, 2, 'Simple pauldrons worn near Shadowlands.'),
(20131, 'Grips of Gnomeregan', 18, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_cloth_12.jpg', 4, 4, 'Simple grips worn near Gnomeregan.'),
(20132, 'Runed Robes of Burning Legion', 57, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_cloth_14.jpg', 5, 3, 'Recovered from ruins left by the fall of Burning Legion.'),
(20133, 'Runed Talisman of Scarlet Crusade', 74, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_cloth_23.jpg', 6, 10, 'Recovered from ruins left by the fall of Scarlet Crusade.'),
(20134, 'Blessed Trousers of Revendreth', 64, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_cloth_25.jpg', 7, 5, 'Recovered from ruins left by the fall of Revendreth.'),
(20135, 'Runed Treads of Necrolords', 69, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_cloth_42.jpg', 8, 6, 'Recovered from ruins left by the fall of Necrolords.'),
(20136, 'Ashen Robes of Gnomeregan', 173, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_cloth_43.jpg', 1, 3, 'Forged in the fires of Gnomeregan during the great conflict.'),
(20137, 'Charged Grips of Shadowlands', 61, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_cloth_46.jpg', 2, 4, 'Recovered from ruins left by the fall of Shadowlands.'),
(20138, 'Handwraps of Orgrimmar', 14, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_leather_04.jpg', 3, 4, 'Simple handwraps worn near Orgrimmar.'),
(20139, 'Runed Handwraps of Silvermoon', 59, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_leather_07.jpg', 4, 4, 'Recovered from ruins left by the fall of Silvermoon.'),
(20140, 'Ashen Gauntlets of Scarlet Crusade', 167, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_leather_08.jpg', 5, 4, 'Forged in the fires of Scarlet Crusade during the great conflict.'),
(20144, 'Claymore of Blackrock', 27, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_plate08.jpg', 1, 7, 'Simple claymore worn near Blackrock.'),
(20145, 'Greaves of Silvermoon', 10, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_plate11.jpg', 2, 6, 'Simple greaves worn near Silvermoon.'),
(20146, 'Blessed Crossbow of Wyrmrest', 45, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_plate13.jpg', 3, 9, 'Recovered from ruins left by the fall of Wyrmrest.'),
(20147, 'Charged Sword of Ashenvale', 47, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_plate15.jpg', 4, 7, 'Recovered from ruins left by the fall of Ashenvale.'),
(20148, 'Stormveiled Ring of Silvermoon', 140, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_plate16.jpg', 5, 10, 'Forged in the fires of Silvermoon during the great conflict.'),
(20149, 'Sabatons of Burning Legion', 23, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_chest_plate_23.jpg', 6, 6, 'Simple sabatons worn near Burning Legion.'),
(20150, 'Mask of Necrolords', 24, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_crate_01.jpg', 7, 1, 'Simple mask worn near Necrolords.'),
(20151, 'Charged Seal of Dragon Isles', 49, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/inv_crate_03.jpg', 8, 10, 'Recovered from ruins left by the fall of Dragon Isles.'),
(20152, 'Legplates of Stormwind', 25, 'common', 'https://wow.zamimg.com/images/wow/icons/large/inv_crate_04.jpg', 1, 5, 'Simple legplates worn near Stormwind.'),
(30000, 'Chestplate of Shadowlands', 21, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/ability_ambush.jpg', 9, 3, 'Standard chestplate used in warlock rituals near Shadowlands.'),
(30001, 'Voidtouched Gloves of Quel\'Thalas', 369, 'legendary', 'https://wow.zamimg.com/images/wow/icons/large/ability_backstab.jpg', 9, 4, '‘Its power was once whispered by the Nathrezim in the vaults of Quel\'Thalas.’'),
(30002, 'Hexed Greaves of Broken Isles', 55, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/ability_creature_cursed_04.jpg', 9, 6, 'Rumored to channel forbidden magic from the depths of Broken Isles.'),
(30003, 'Felbound Sigil of Felwood', 52, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/ability_creature_poison_04.jpg', 9, 10, 'Rumored to channel forbidden magic from the depths of Felwood.'),
(30004, 'Darkwoven Ring of Broken Isles', 48, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/ability_creature_poison_06.jpg', 9, 10, 'Rumored to channel forbidden magic from the depths of Broken Isles.'),
(30005, 'Darkwoven Visage of Silvermoon', 54, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/ability_dualwield.jpg', 9, 1, 'Rumored to channel forbidden magic from the depths of Silvermoon.'),
(30006, 'Hexed Handwraps of Gnomeregan', 74, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/ability_eyeoftheowl.jpg', 9, 4, 'Rumored to channel forbidden magic from the depths of Gnomeregan.'),
(30007, 'Eternal Handwraps of Torghast', 438, 'legendary', 'https://wow.zamimg.com/images/wow/icons/large/ability_golemthunderclap.jpg', 9, 4, '‘Its power was once whispered by the Nathrezim in the vaults of Torghast.’'),
(30008, 'Soulforged Treads of Orgrimmar', 196, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/ability_gouge.jpg', 9, 6, 'Crafted in secret during the shadow wars beneath Orgrimmar.'),
(30009, 'Darkwoven Tunic of Drakkari', 50, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/ability_hunter_beasttaming.jpg', 9, 3, 'Rumored to channel forbidden magic from the depths of Drakkari.'),
(30010, 'Voidtouched Crown of Necrolords', 329, 'legendary', 'https://wow.zamimg.com/images/wow/icons/large/ability_hunter_beasttraining.jpg', 9, 1, '‘Its power was once whispered by the Nathrezim in the vaults of Necrolords.’'),
(30011, 'Mask of Bastion', 28, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_hunter_mendpet.jpg', 9, 1, 'Standard mask used in warlock rituals near Bastion.'),
(30012, 'Gloves of Twilight\'s Hammer', 19, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_hunter_pet_bear.jpg', 9, 4, 'Standard gloves used in warlock rituals near Twilight\'s Hammer.'),
(30013, 'Grimoire-bound Rod of Torghast', 122, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/ability_hunter_pet_gorilla.jpg', 9, 8, 'Crafted in secret during the shadow wars beneath Torghast.'),
(30014, 'Rod of Wyrmrest', 22, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_hunter_pet_owl.jpg', 9, 8, 'Standard rod used in warlock rituals near Wyrmrest.'),
(30015, 'Visage of Wyrmrest', 14, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_hunter_pet_wolf.jpg', 9, 1, 'Standard visage used in warlock rituals near Wyrmrest.'),
(30016, 'Darkwoven Greaves of Dalaran', 48, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/ability_mage_conjurefoodrank9.jpg', 9, 6, 'Rumored to channel forbidden magic from the depths of Dalaran.'),
(30017, 'Grips of Dragon Isles', 20, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_mage_netherwindpresence.jpg', 9, 4, 'Standard grips used in warlock rituals near Dragon Isles.'),
(30018, 'Soulforged Grips of Felwood', 109, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/ability_mount_blackdirewolf.jpg', 9, 4, 'Crafted in secret during the shadow wars beneath Felwood.'),
(30019, 'Gloves of Maldraxxus', 23, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_mount_blackpanther.jpg', 9, 4, 'Standard gloves used in warlock rituals near Maldraxxus.'),
(30020, 'Rod of Dalaran', 10, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_mount_dreadsteed.jpg', 9, 8, 'Standard rod used in warlock rituals near Dalaran.'),
(30021, 'Sigil of The Void', 28, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_mount_jungletiger.jpg', 9, 10, 'Standard sigil used in warlock rituals near The Void.'),
(30022, 'Soulforged Sabatons of Necrolords', 134, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/ability_mount_kodo_03.jpg', 9, 6, 'Crafted in secret during the shadow wars beneath Necrolords.'),
(30023, 'Felbound Armor of Ahn\'Qiraj', 77, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/ability_mount_mechastrider.jpg', 9, 3, 'Rumored to channel forbidden magic from the depths of Ahn\'Qiraj.'),
(30024, 'Grimoire-bound Boots of Quel\'Thalas', 158, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/ability_mount_mountainram.jpg', 9, 6, 'Crafted in secret during the shadow wars beneath Quel\'Thalas.'),
(30025, 'Sigil of Dalaran', 13, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_mount_nightmarehorse.jpg', 9, 10, 'Standard sigil used in warlock rituals near Dalaran.'),
(30026, 'Staff of Broken Isles', 28, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_mount_raptor.jpg', 9, 8, 'Standard staff used in warlock rituals near Broken Isles.'),
(30027, 'Felbound Armor of Zandalar', 80, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/ability_mount_ridinghorse.jpg', 9, 3, 'Rumored to channel forbidden magic from the depths of Zandalar.'),
(30028, 'Grimoire-bound Sigil of Dreadmaul', 113, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/ability_mount_undeadhorse.jpg', 9, 10, 'Crafted in secret during the shadow wars beneath Dreadmaul.'),
(30029, 'Treads of Shadowlands', 30, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_mount_whitetiger.jpg', 9, 6, 'Standard treads used in warlock rituals near Shadowlands.'),
(30030, 'Felbound Seal of Ashenvale', 64, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/ability_paladin_blessedhands.jpg', 9, 10, 'Rumored to channel forbidden magic from the depths of Ashenvale.'),
(30031, 'Darkwoven Rod of Boralus', 63, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/ability_paladin_hammeroftherighteous.jpg', 9, 8, 'Rumored to channel forbidden magic from the depths of Boralus.'),
(30032, 'Shadowfused Tunic of Revendreth', 183, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/ability_paladin_sheathoflight.jpg', 9, 3, 'Crafted in secret during the shadow wars beneath Revendreth.'),
(30033, 'Grimoire-bound Sigil of Revendreth', 180, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/ability_poisons.jpg', 9, 10, 'Crafted in secret during the shadow wars beneath Revendreth.'),
(30034, 'Grimoire-bound Gloves of Blackrock', 149, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/ability_poisonsting.jpg', 9, 4, 'Crafted in secret during the shadow wars beneath Blackrock.'),
(30035, 'Armor of Scarlet Crusade', 21, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_rogue_disguise.jpg', 9, 3, 'Standard armor used in warlock rituals near Scarlet Crusade.'),
(30036, 'Shadowfused Crown of Stormwind', 199, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/ability_rogue_dualweild.jpg', 9, 1, 'Crafted in secret during the shadow wars beneath Stormwind.'),
(30037, 'Band of Stormwind', 11, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_rogue_rupture.jpg', 9, 10, 'Standard band used in warlock rituals near Stormwind.'),
(30038, 'Handwraps of Gnomeregan', 11, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_smash.jpg', 9, 4, 'Standard handwraps used in warlock rituals near Gnomeregan.'),
(30039, 'Grimoire-bound Talisman of Dragon Isles', 162, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/ability_spy.jpg', 9, 10, 'Crafted in secret during the shadow wars beneath Dragon Isles.'),
(30040, 'Grimoire-bound Armor of Bastion', 180, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/ability_thunderbolt.jpg', 9, 3, 'Crafted in secret during the shadow wars beneath Bastion.'),
(30041, 'Mask of The Void', 21, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_upgrademoonglaive.jpg', 9, 1, 'Standard mask used in warlock rituals near The Void.'),
(30042, 'Shadowfused Visage of Drakkari', 192, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/ability_warlock_improvedsoulleech.jpg', 9, 1, 'Crafted in secret during the shadow wars beneath Drakkari.'),
(30043, 'Gloves of Shadowlands', 18, 'common', 'https://wow.zamimg.com/images/wow/icons/large/ability_warlock_incubus.jpg', 9, 4, 'Standard gloves used in warlock rituals near Shadowlands.'),
(30044, 'Shadowfused Talisman of Kul Tiras', 183, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/ability_warrior_sunder.jpg', 9, 10, 'Crafted in secret during the shadow wars beneath Kul Tiras.'),
(30045, 'Darkwoven Mask of Stormwind', 69, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/ability_warrior_warcry.jpg', 9, 1, 'Rumored to channel forbidden magic from the depths of Stormwind.'),
(30046, 'Darkwoven Handwraps of Maldraxxus', 63, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/ability_whirlwind.jpg', 9, 4, 'Rumored to channel forbidden magic from the depths of Maldraxxus.'),
(30047, 'Grimoire-bound Robes of Wyrmrest', 119, 'epic', 'https://wow.zamimg.com/images/wow/icons/large/achievement_boss_fourhorsemen.jpg', 9, 3, 'Crafted in secret during the shadow wars beneath Wyrmrest.'),
(30048, 'Darkwoven Branch of Dreadmaul', 74, 'rare', 'https://wow.zamimg.com/images/wow/icons/large/achievement_dungeon_cotstratholme.jpg', 9, 8, 'Rumored to channel forbidden magic from the depths of Dreadmaul.'),
(30049, 'Band of Dragon Isles', 10, 'common', 'https://wow.zamimg.com/images/wow/icons/large/achievement_dungeon_naxxramas.jpg', 9, 10, 'Standard band used in warlock rituals near Dragon Isles.'),
(30050, 'test', 500, 'legendary', 'https://wow.zamimg.com/images/wow/icons/large/spell_frost_frostbolt02.jpg', 9, 7, 'test'),
(30052, 'test', 999, '', 'https://wow.zamimg.com/images/wow/icons/large/achievement_zone_outland_01.jpg', 6, 6, 'test'),
(30054, 'test', 50, 'common', 'https://wow.zamimg.com/images/wow/icons/large/classicon_priest.jpg', 1, 1, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `sp_type`
--

CREATE TABLE `sp_type` (
  `type_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_type`
--

INSERT INTO `sp_type` (`type_id`, `name`, `section`, `description`) VALUES
(1, 'Helmet', 'Armor', 'Guards your head'),
(2, 'Shoulders', 'Armor', 'Guards your shoulders'),
(3, 'Chest', 'Armor', 'Guards your chest'),
(4, 'Hands', 'Armor', 'Guards your hands'),
(5, 'Legs', 'Armor', 'Guards your legs'),
(6, 'Boots', 'Armor', 'Guards your foot'),
(7, 'Sword', 'Weapons', 'You can use it as a weapon'),
(8, 'Staff', 'Weapons', 'Helps you cast useful spells'),
(9, 'Bow', 'Weapons', 'You can kill from afar'),
(10, 'Ring', 'Accessories', 'It can help you be more magical');

-- --------------------------------------------------------

--
-- Table structure for table `sp_users`
--

CREATE TABLE `sp_users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `class_id` int(11) NOT NULL,
  `privilege_id` int(11) NOT NULL,
  `filter` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_users`
--

INSERT INTO `sp_users` (`user_id`, `name`, `email`, `password`, `class_id`, `privilege_id`, `filter`) VALUES
(1, 'David', 'david@wow.com', '$2y$10$8dDXx.C29wUFHYjT.KQc9Ok9HAKMSXd4/pDCQ0kpvn1kQcqZC3XJG', 2, 1, 0),
(2, 'Petr', 'Petr@wow.com', '$2y$10$K2NDFVdvG99jElvZPtc7Ie6UiYGKqzBh7ALfv5KGLmHr/DXd82HE6', 3, 2, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sp_carts`
--
ALTER TABLE `sp_carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sp_cart_items`
--
ALTER TABLE `sp_cart_items`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD KEY `cart_id` (`cart_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `sp_classes`
--
ALTER TABLE `sp_classes`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `sp_orders`
--
ALTER TABLE `sp_orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sp_order_items`
--
ALTER TABLE `sp_order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `sp_privileges`
--
ALTER TABLE `sp_privileges`
  ADD PRIMARY KEY (`privilege_id`);

--
-- Indexes for table `sp_products`
--
ALTER TABLE `sp_products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `class_id` (`class_id`,`type_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `sp_type`
--
ALTER TABLE `sp_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `sp_users`
--
ALTER TABLE `sp_users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `class_id` (`class_id`,`privilege_id`),
  ADD KEY `privilege_id` (`privilege_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sp_carts`
--
ALTER TABLE `sp_carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sp_cart_items`
--
ALTER TABLE `sp_cart_items`
  MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `sp_classes`
--
ALTER TABLE `sp_classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sp_orders`
--
ALTER TABLE `sp_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `sp_order_items`
--
ALTER TABLE `sp_order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `sp_privileges`
--
ALTER TABLE `sp_privileges`
  MODIFY `privilege_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sp_products`
--
ALTER TABLE `sp_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30056;

--
-- AUTO_INCREMENT for table `sp_type`
--
ALTER TABLE `sp_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sp_users`
--
ALTER TABLE `sp_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sp_carts`
--
ALTER TABLE `sp_carts`
  ADD CONSTRAINT `sp_carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `sp_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sp_cart_items`
--
ALTER TABLE `sp_cart_items`
  ADD CONSTRAINT `sp_cart_items_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `sp_carts` (`cart_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sp_cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `sp_products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sp_orders`
--
ALTER TABLE `sp_orders`
  ADD CONSTRAINT `sp_orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `sp_users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `sp_order_items`
--
ALTER TABLE `sp_order_items`
  ADD CONSTRAINT `sp_order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `sp_products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sp_order_items_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `sp_orders` (`order_id`);

--
-- Constraints for table `sp_products`
--
ALTER TABLE `sp_products`
  ADD CONSTRAINT `sp_products_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `sp_type` (`type_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sp_products_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `sp_classes` (`class_id`) ON UPDATE CASCADE;

--
-- Constraints for table `sp_users`
--
ALTER TABLE `sp_users`
  ADD CONSTRAINT `sp_users_ibfk_1` FOREIGN KEY (`privilege_id`) REFERENCES `sp_privileges` (`privilege_id`),
  ADD CONSTRAINT `sp_users_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `sp_classes` (`class_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
