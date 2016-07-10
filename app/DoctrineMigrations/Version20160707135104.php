<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160707135104 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE about (id INT AUTO_INCREMENT NOT NULL, banner_image_id INT DEFAULT NULL, image_name VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, subtitle VARCHAR(255) NOT NULL, title_why VARCHAR(255) NOT NULL, title_mission VARCHAR(255) NOT NULL, title_do VARCHAR(255) NOT NULL, content_why LONGTEXT NOT NULL, content_mission LONGTEXT NOT NULL, content_do LONGTEXT NOT NULL, video VARCHAR(255) NOT NULL, content_video LONGTEXT NOT NULL, title_video VARCHAR(255) NOT NULL, created DATETIME NOT NULL, UNIQUE INDEX UNIQ_B5F422E33F9CEB4E (banner_image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE banner_image (id INT AUTO_INCREMENT NOT NULL, image_name VARCHAR(255) NOT NULL, title VARCHAR(225) DEFAULT NULL, created DATETIME NOT NULL, online TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE about ADD CONSTRAINT FK_B5F422E33F9CEB4E FOREIGN KEY (banner_image_id) REFERENCES banner_image (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE about DROP FOREIGN KEY FK_B5F422E33F9CEB4E');
        $this->addSql('DROP TABLE about');
        $this->addSql('DROP TABLE banner_image');
    }
}
