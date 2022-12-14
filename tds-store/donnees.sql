AddNumberOrderToPartenairesTable: alter table `partenaires` add `number_order` int null after `image_id`
AddNumberOrderToPartenairesTable: alter table `partenaires` add unique `partenaires_number_order_unique`(`number_order`)
AddNumberOrderToPublicitesTable: alter table `publicites` add `number_order` int null after `image_id`
AddNumberOrderToPublicitesTable: alter table `publicites` add unique `publicites_number_order_unique`(`number_order`)
