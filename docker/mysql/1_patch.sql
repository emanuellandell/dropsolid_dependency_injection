ALTER TABLE node_revision ADD COLUMN revision_default tinyint(5) AFTER revision_log;
ALTER TABLE block_content_revision ADD COLUMN revision_default tinyint(5) AFTER revision_log;
ALTER TABLE crop_revision ADD COLUMN revision_default tinyint(5) AFTER revision_log;
ALTER TABLE paragraphs_item_revision ADD COLUMN revision_default tinyint(5) AFTER revision_uid;
