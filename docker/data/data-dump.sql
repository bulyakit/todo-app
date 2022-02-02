--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `task`
--
USE test;
CREATE TABLE `task` (
  `id` int(10) NOT NULL,
  `task_name` varchar(120) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `datetime` varchar(30) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `is_done` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `task_name`, `datetime`, `is_done`, `created_at`) VALUES
(1, 'teszt név 1', '2022-01-11 01:00:00', 0, '2022-02-01 19:01:41'),
(2, 'teszt név 1', '2022-01-20 11:00:00', 0, '2022-02-02 16:51:04'),
(3, 'teszt név 1', '2022-01-20 11:00:00', 0, '2022-02-02 17:50:14');

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

