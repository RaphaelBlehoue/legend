<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160701132922 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE dossier ADD pack_id INT NOT NULL');
        $this->addSql('ALTER TABLE dossier ADD CONSTRAINT FK_3D48E0371919B217 FOREIGN KEY (pack_id) REFERENCES packs (id)');
        $this->addSql('CREATE INDEX IDX_3D48E0371919B217 ON dossier (pack_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE dossier DROP FOREIGN KEY FK_3D48E0371919B217');
        $this->addSql('DROP INDEX IDX_3D48E0371919B217 ON dossier');
        $this->addSql('ALTER TABLE dossier DROP pack_id');
    }
}
