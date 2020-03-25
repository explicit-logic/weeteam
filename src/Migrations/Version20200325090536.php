<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200325090536 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE dossier_address (id INT AUTO_INCREMENT NOT NULL, dossier_id INT NOT NULL, address VARCHAR(255) NOT NULL, INDEX IDX_4F1486B9611C0C56 (dossier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dossier_card (id INT AUTO_INCREMENT NOT NULL, dossier_id INT NOT NULL, number CHAR(16) NOT NULL, cvv VARCHAR(4) NOT NULL, INDEX IDX_9A2E59A0611C0C56 (dossier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dossier (id INT AUTO_INCREMENT NOT NULL, number VARCHAR(6) NOT NULL, type VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_3D48E03796901F54 (number), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dossier_address ADD CONSTRAINT FK_4F1486B9611C0C56 FOREIGN KEY (dossier_id) REFERENCES dossier (id)');
        $this->addSql('ALTER TABLE dossier_card ADD CONSTRAINT FK_9A2E59A0611C0C56 FOREIGN KEY (dossier_id) REFERENCES dossier (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE dossier_address DROP FOREIGN KEY FK_4F1486B9611C0C56');
        $this->addSql('ALTER TABLE dossier_card DROP FOREIGN KEY FK_9A2E59A0611C0C56');
        $this->addSql('DROP TABLE dossier_address');
        $this->addSql('DROP TABLE dossier_card');
        $this->addSql('DROP TABLE dossier');
    }
}
