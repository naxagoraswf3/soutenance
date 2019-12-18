<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191212170512 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE function_thermoplastique');
        $this->addSql('DROP TABLE prenom');
        $this->addSql('ALTER TABLE commande DROP created_at, CHANGE complement complement VARCHAR(255) NOT NULL, CHANGE autrefonction autrefonction LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande_coating CHANGE autrefonction autrefonction LONGTEXT DEFAULT NULL, CHANGE created_at created_at DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE function_thermoplastique (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, actif TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE prenom (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE commande ADD created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE complement complement LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE autrefonction autrefonction INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande_coating CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE autrefonction autrefonction INT DEFAULT NULL');
    }
}
