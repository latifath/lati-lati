AddSortIdToCategoriesTable: alter table `categories` add `sort_id` int null after `slug`
AddSortIdToCategoriesTable: alter table `categories` add unique `categories_sort_id`(`sort_id`)
