<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160701122856 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE best (id INT AUTO_INCREMENT NOT NULL, dossier_id INT NOT NULL, name VARCHAR(255) NOT NULL, content LONGTEXT DEFAULT NULL, media VARCHAR(255) NOT NULL, INDEX IDX_AD0D764F611C0C56 (dossier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dossier (id INT AUTO_INCREMENT NOT NULL, wedding_men VARCHAR(255) NOT NULL, wedding_women VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, ceremony_date DATE NOT NULL, colors VARCHAR(255) NOT NULL, video VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dossier_type (dossier_id INT NOT NULL, type_id INT NOT NULL, INDEX IDX_E4965A611C0C56 (dossier_id), INDEX IDX_E4965AC54C8C93 (type_id), PRIMARY KEY(dossier_id, type_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, dossier_id INT NOT NULL, url VARCHAR(255) NOT NULL, status TINYINT(1) NOT NULL, actived TINYINT(1) NOT NULL, INDEX IDX_6A2CA10C611C0C56 (dossier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE best ADD CONSTRAINT FK_AD0D764F611C0C56 FOREIGN KEY (dossier_id) REFERENCES dossier (id)');
        $this->addSql('ALTER TABLE dossier_type ADD CONSTRAINT FK_E4965A611C0C56 FOREIGN KEY (dossier_id) REFERENCES dossier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dossier_type ADD CONSTRAINT FK_E4965AC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C611C0C56 FOREIGN KEY (dossier_id) REFERENCES dossier (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE best DROP FOREIGN KEY FK_AD0D764F611C0C56');
        $this->addSql('ALTER TABLE dossier_type DROP FOREIGN KEY FK_E4965A611C0C56');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C611C0C56');
        $this->addSql('DROP TABLE best');
        $this->addSql('DROP TABLE dossier');
        $this->addSql('DROP TABLE dossier_type');
        $this->addSql('DROP TABLE media');
    }
}
