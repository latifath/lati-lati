AddNumberOrderToPartenairesTable: alter table `partenaires` add `number_order` int not null default '0' after `image_id`
AddNumberOrderToPublicitesTable: alter table `publicites` add `number_order` int not null default '0' after `image_id`
AddFileIdToProduitsTable: alter table `produits` add `file_id` int unsigned null after `image_id`
