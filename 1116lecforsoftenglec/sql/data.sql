CREATE TABLE user_accounts (
	user_id INT AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(255),
	first_name VARCHAR(255),
	last_name VARCHAR(255),
	password TEXT,
	date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);

create table branches (
	branch_id INT,
	address VARCHAR(50),
	head_manager VARCHAR(50),
	contact_number VARCHAR(50),
	date_added DATE,
	added_by INT,
	last_updated DATE,
	last_updated_by INT
);

CREATE TABLE branches_update_logs (
	branch_update_log_id INT AUTO_INCREMENT PRIMARY KEY,
	address VARCHAR(50),
	head_manager VARCHAR(50),
	contact_number VARCHAR(50),
	branch_id INT,
	added_by INT,
	date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (1, 'PO Box 65589', 'Sofie Marconi', '360-895-3726', '2024-08-07 23:05:51', 4, '2023-11-08 13:08:10', 7);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (2, 'PO Box 70483', 'Jannel Kilius', '666-634-2075', '2024-09-04 07:54:52', 2, '2024-08-27 18:55:25', 6);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (3, 'Apt 284', 'Hermann Hudspeth', '583-881-9983', '2024-04-29 09:25:23', 8, '2024-10-30 00:19:48', 7);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (4, 'Apt 1910', 'Ursula Handaside', '291-932-9601', '2024-09-15 00:49:45', 2, '2023-11-12 11:52:11', 1);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (5, 'PO Box 48690', 'Modestine Seal', '617-504-0263', '2024-07-27 19:19:54', 8, '2024-03-07 23:01:17', 4);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (6, 'Apt 1286', 'Alfons Hamprecht', '485-743-5149', '2024-03-15 18:20:59', 4, '2024-10-17 20:15:32', 4);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (7, '5th Floor', 'Elsa Hinckley', '236-620-2787', '2024-08-14 22:16:21', 4, '2024-01-24 02:02:55', 3);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (8, 'Room 1205', 'Dorene Bawle', '289-963-6177', '2024-08-08 06:51:23', 1, '2024-07-09 00:58:52', 10);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (9, 'Suite 4', 'Laverne Driscoll', '588-719-8169', '2024-01-12 22:53:28', 9, '2024-06-05 02:56:37', 4);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (10, 'Room 1876', 'Hoebart Illing', '911-465-1749', '2024-10-08 09:44:29', 9, '2024-08-26 18:07:48', 6);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (11, 'Apt 19', 'Georges Dorkens', '820-459-2100', '2024-07-27 17:58:11', 5, '2023-12-22 02:21:06', 10);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (12, 'PO Box 52876', 'Raimundo Hammor', '480-961-3840', '2024-04-07 23:58:55', 1, '2024-01-23 01:21:26', 6);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (13, 'Suite 40', 'Antons Poynor', '828-792-7188', '2024-09-29 21:28:55', 3, '2024-07-08 04:04:50', 4);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (14, 'Apt 1989', 'Mick Sketch', '135-483-3527', '2024-05-10 18:37:31', 4, '2023-12-23 01:59:32', 9);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (15, 'Suite 32', 'Farand Neubigging', '984-811-9126', '2023-12-05 05:23:44', 7, '2024-09-20 02:59:35', 4);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (16, '3rd Floor', 'Filippa Tettley', '117-946-3505', '2024-03-10 19:52:03', 3, '2024-03-17 00:28:18', 1);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (17, 'Room 43', 'Luis Shavel', '406-746-8423', '2024-09-02 20:47:58', 4, '2023-11-21 12:45:04', 2);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (18, 'PO Box 7954', 'Skippy Pentelo', '187-166-6983', '2024-10-21 10:38:19', 3, '2023-11-29 04:15:50', 10);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (19, 'Apt 1869', 'Morissa Atwell', '233-383-8324', '2023-11-12 22:29:26', 6, '2024-07-23 04:26:20', 7);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (20, 'PO Box 88928', 'Rozelle Gyenes', '347-117-9062', '2024-06-12 20:09:56', 1, '2024-07-28 22:18:10', 8);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (21, 'Suite 88', 'Vallie Littlejohn', '786-129-0597', '2024-01-06 19:56:43', 4, '2024-04-16 00:48:36', 1);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (22, 'Room 1572', 'Neddie Lewerenz', '729-161-0715', '2024-10-09 16:33:22', 2, '2024-08-15 11:55:00', 2);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (23, 'PO Box 76584', 'Guntar Worster', '239-372-5618', '2024-05-26 21:45:07', 3, '2024-08-03 16:41:03', 10);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (24, 'PO Box 79214', 'Deloria Bleacher', '106-170-5487', '2024-07-12 23:14:29', 2, '2024-07-27 14:28:21', 10);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (25, 'Room 547', 'Angelo Cornill', '894-593-6742', '2024-02-13 21:41:42', 5, '2024-04-18 10:59:16', 1);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (26, 'PO Box 51101', 'Genevra Campagne', '361-950-1305', '2024-09-28 14:05:16', 5, '2023-12-25 01:28:15', 8);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (27, 'Suite 6', 'Mickie Norris', '359-572-3066', '2024-02-05 03:44:29', 9, '2024-01-17 00:03:35', 5);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (28, '18th Floor', 'Daphne MacQuist', '942-295-2913', '2024-01-30 14:27:56', 8, '2024-06-29 17:29:08', 6);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (29, 'Apt 1618', 'Faydra Redit', '453-764-4747', '2024-08-30 10:27:58', 5, '2024-07-09 22:47:36', 1);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (30, 'Apt 1887', 'Cordie Huddlestone', '858-948-8086', '2024-01-03 22:59:53', 4, '2024-01-31 02:19:54', 8);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (31, 'Apt 1794', 'Arron Ritson', '821-822-1541', '2024-10-27 13:12:13', 8, '2024-09-10 14:10:28', 2);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (32, 'Suite 18', 'Joyous McIndrew', '261-908-4835', '2023-11-09 14:35:40', 6, '2023-12-18 07:57:34', 2);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (33, 'Apt 1849', 'Willetta Breach', '892-969-9930', '2024-08-04 20:38:23', 9, '2024-05-07 07:08:34', 4);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (34, 'Apt 110', 'Charissa Loalday', '165-952-7177', '2024-07-16 05:50:15', 9, '2024-03-18 16:18:42', 5);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (35, 'Room 1236', 'Tania Chasemore', '301-551-3653', '2023-11-27 15:54:28', 8, '2024-01-09 12:13:02', 4);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (36, 'Apt 765', 'Herminia Brittain', '919-208-7169', '2024-03-19 07:32:36', 3, '2024-06-16 19:38:55', 3);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (37, 'Room 1233', 'Vicki Frenchum', '623-743-2097', '2023-12-28 11:29:37', 8, '2024-05-25 03:32:18', 7);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (38, 'Suite 26', 'Magdalena Caveill', '910-186-3124', '2024-09-20 01:06:30', 2, '2024-04-03 01:52:42', 3);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (39, 'Room 1014', 'Marilee Garbutt', '178-685-0356', '2024-04-18 18:07:14', 6, '2024-10-08 06:03:54', 9);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (40, 'Apt 1506', 'Warden Skeemer', '220-128-9661', '2023-11-04 13:30:41', 3, '2024-10-22 13:08:33', 7);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (41, 'Suite 89', 'Cassondra Algate', '615-647-3067', '2024-07-13 17:38:24', 5, '2023-12-26 17:41:05', 6);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (42, 'Room 1499', 'Xever Dunsleve', '343-493-8332', '2024-06-08 23:53:06', 2, '2024-09-27 23:23:17', 4);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (43, 'Apt 825', 'Cash Schimann', '778-470-1241', '2024-07-22 23:49:12', 8, '2024-01-01 23:44:23', 7);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (44, 'Room 31', 'Isak Hampton', '261-875-9705', '2023-11-17 03:28:17', 5, '2024-05-20 03:35:37', 7);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (45, 'Room 363', 'Oswald Petranek', '553-522-6125', '2024-07-04 07:37:36', 1, '2023-12-04 01:34:05', 6);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (46, 'Apt 928', 'Cherrita Lloyds', '552-387-1697', '2024-08-04 22:30:47', 8, '2023-12-22 23:09:29', 1);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (47, 'PO Box 85963', 'Kali Potteril', '311-721-0412', '2024-02-22 14:44:59', 4, '2024-09-07 01:54:44', 9);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (48, 'Suite 45', 'Henka Cram', '423-312-9793', '2024-10-05 12:04:58', 9, '2023-12-12 08:06:15', 8);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (49, 'PO Box 23780', 'Janice Bambery', '779-199-3996', '2024-10-21 03:16:40', 2, '2024-07-20 01:30:35', 6);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (50, 'PO Box 87482', 'Elsworth Aldgate', '490-669-7843', '2024-07-19 06:17:01', 1, '2024-01-25 10:05:17', 10);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (51, 'Room 109', 'Fenelia Olliff', '565-384-3722', '2024-04-29 09:51:47', 5, '2024-03-02 01:23:23', 3);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (52, 'Room 539', 'Susan Dunbabin', '556-121-5455', '2024-09-23 02:35:09', 2, '2023-11-17 22:20:38', 5);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (53, 'PO Box 91751', 'Ailene Buttner', '209-208-6453', '2024-03-03 03:16:47', 10, '2024-05-05 15:31:18', 8);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (54, '11th Floor', 'Garek Kelmere', '196-387-5490', '2024-08-16 04:58:46', 5, '2023-11-13 10:48:46', 4);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (55, 'Suite 62', 'Rhianon Saveall', '768-907-7309', '2024-10-16 16:13:20', 3, '2024-09-29 14:42:34', 4);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (56, 'Room 1255', 'Nisse Thornthwaite', '931-102-4184', '2023-11-19 01:12:47', 10, '2024-10-17 18:20:25', 8);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (57, 'PO Box 6923', 'Kristen Hedde', '403-877-3330', '2024-09-10 18:46:43', 2, '2024-01-25 07:52:56', 6);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (58, 'Suite 40', 'Cam Jackman', '681-494-8514', '2023-12-30 21:09:26', 5, '2023-12-15 22:57:49', 6);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (59, 'Suite 18', 'Uta Galley', '348-227-7555', '2024-07-06 05:29:13', 2, '2024-10-09 19:38:32', 7);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (60, 'Room 1367', 'Lon Varlow', '267-192-2605', '2024-10-26 10:33:49', 7, '2024-06-07 00:20:20', 1);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (61, 'PO Box 41948', 'Trip Grafton', '235-764-5674', '2024-02-18 18:41:01', 5, '2024-08-10 06:38:20', 8);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (62, 'PO Box 8288', 'Peder Delaprelle', '379-356-4899', '2024-02-19 15:17:32', 6, '2024-04-20 19:03:01', 1);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (63, 'Suite 97', 'Sherye Wheeldon', '633-189-4015', '2024-02-21 16:22:25', 7, '2024-01-19 14:20:59', 7);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (64, 'Room 227', 'Charles Secker', '713-462-7258', '2023-12-14 16:59:38', 2, '2024-02-21 15:10:42', 7);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (65, '12th Floor', 'Horacio Cruise', '747-957-7335', '2024-04-15 08:55:49', 8, '2024-10-22 07:18:25', 4);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (66, 'Room 627', 'Brittne Dumini', '577-750-9803', '2024-07-29 06:28:57', 2, '2023-11-16 19:33:45', 4);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (67, 'PO Box 58940', 'Nikaniki Rylands', '931-670-4404', '2023-12-21 07:03:19', 3, '2024-05-14 08:09:44', 6);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (68, 'PO Box 87495', 'Dolorita Panas', '858-480-1444', '2024-05-02 04:50:06', 9, '2023-11-22 02:10:52', 9);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (69, 'PO Box 26379', 'Ivett Battista', '798-725-8226', '2024-06-19 23:13:34', 10, '2023-12-10 18:42:49', 2);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (70, 'Room 55', 'Phoebe Kalberer', '643-846-4836', '2024-03-11 16:08:34', 3, '2024-02-01 10:47:38', 6);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (71, 'PO Box 38159', 'Debor Bolingbroke', '229-162-5883', '2024-04-11 16:55:41', 6, '2024-10-23 13:13:37', 7);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (72, 'Suite 67', 'Lissie Gowland', '415-282-2320', '2024-07-02 09:10:59', 9, '2024-05-14 02:46:35', 4);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (73, 'Room 1879', 'Alasteir Clemmitt', '112-953-0404', '2023-11-14 16:25:34', 3, '2024-03-20 17:35:52', 9);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (74, 'Apt 46', 'Calida Libbey', '574-235-4032', '2023-11-15 14:13:12', 1, '2024-08-24 01:14:14', 5);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (75, 'Suite 2', 'Oren Coulthard', '967-680-3232', '2024-10-09 17:07:30', 7, '2023-11-24 20:52:22', 5);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (76, 'PO Box 57487', 'Morgen Fullalove', '936-590-4364', '2024-04-17 08:28:04', 10, '2024-02-23 16:06:27', 7);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (77, 'Apt 1138', 'Vivienne Bartleman', '206-589-9344', '2023-12-05 01:25:00', 3, '2024-07-31 23:08:15', 9);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (78, '13th Floor', 'Robena Clever', '225-387-2108', '2023-12-13 16:06:11', 5, '2024-01-23 11:54:30', 4);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (79, '10th Floor', 'Carmella Small', '329-307-2550', '2024-05-17 16:17:49', 5, '2024-08-16 15:11:36', 3);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (80, 'PO Box 91384', 'Emelyne Smullen', '305-254-6583', '2024-03-13 23:39:12', 4, '2024-06-02 11:57:48', 7);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (81, 'Apt 1648', 'Pauline Yaknov', '112-148-1991', '2023-12-26 09:33:03', 8, '2024-10-26 11:03:22', 10);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (82, 'Suite 92', 'Annabela Lesley', '321-652-3015', '2024-09-20 22:38:35', 10, '2024-04-21 11:19:05', 9);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (83, '16th Floor', 'Abelard Jorgesen', '651-139-3308', '2023-11-14 23:35:12', 3, '2024-03-23 12:16:14', 8);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (84, '19th Floor', 'Myer MacRitchie', '848-335-9381', '2024-04-02 12:42:22', 8, '2023-12-14 03:48:46', 1);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (85, 'Apt 763', 'Brady Gorler', '932-658-9846', '2024-06-08 02:37:30', 5, '2023-12-29 14:42:38', 1);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (86, 'Room 841', 'Charmine Yabsley', '609-743-1309', '2023-12-26 03:48:55', 4, '2024-03-22 10:28:49', 8);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (87, 'PO Box 51192', 'Amalee Kellart', '639-105-3256', '2023-12-28 04:11:29', 7, '2024-10-23 21:37:34', 6);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (88, 'Room 497', 'Augustin Cantero', '785-161-0312', '2024-10-07 07:16:35', 7, '2024-09-23 14:20:16', 5);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (89, 'Room 1843', 'Kimberlee Linner', '353-313-0450', '2024-08-21 06:55:08', 8, '2024-09-01 17:49:05', 1);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (90, 'Apt 447', 'Barry Fazzioli', '391-898-9739', '2024-04-16 11:52:41', 9, '2024-03-20 01:57:33', 2);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (91, 'Room 167', 'Marvin Almey', '331-680-2520', '2024-07-27 01:36:41', 1, '2024-03-13 08:07:05', 2);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (92, 'Room 77', 'Lane Arsmith', '364-415-3127', '2024-03-13 19:30:49', 4, '2024-01-07 11:49:19', 2);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (93, 'Room 1344', 'Alic Ravenshear', '411-299-3042', '2024-10-28 10:05:52', 4, '2024-07-08 16:37:26', 4);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (94, 'PO Box 23585', 'Leonardo Ovize', '889-548-4523', '2024-02-29 14:38:48', 10, '2023-12-11 03:10:51', 1);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (95, 'PO Box 4023', 'Pat le Keux', '198-520-0731', '2024-04-21 06:42:06', 5, '2024-06-18 20:19:25', 10);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (96, 'Room 787', 'Cathee Jaeggi', '853-190-2212', '2023-12-08 15:27:03', 9, '2023-12-14 15:53:48', 2);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (97, '17th Floor', 'Frank Stockell', '692-896-2581', '2023-11-08 08:53:34', 3, '2023-12-05 22:51:17', 8);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (98, '15th Floor', 'Rube Tendahl', '816-155-7701', '2024-08-24 15:04:10', 2, '2024-07-31 21:02:19', 8);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (99, 'Apt 1873', 'Munmro Astin', '497-434-1120', '2024-08-24 22:14:33', 8, '2024-09-13 15:10:56', 3);
insert into branches (branch_id, address, head_manager, contact_number, date_added, added_by, last_updated, last_updated_by) values (100, 'PO Box 47790', 'Ericha Garrattley', '478-405-8507', '2023-11-14 14:40:53', 6, '2024-02-07 01:45:23', 4);
