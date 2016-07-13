<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160713160258 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE dossier ADD content_wedding_men LONGTEXT NOT NULL, ADD profile_men VARCHAR(225) NOT NULL, ADD content_wedding_women LONGTEXT NOT NULL, ADD profile_women VARCHAR(225) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8CDE5729989D9B62 ON type (slug)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE dossier DROP content_wedding_men, DROP profile_men, DROP content_wedding_women, DROP profile_women');
        $this->addSql('DROP INDEX UNIQ_8CDE5729989D9B62 ON type');
    }
}
