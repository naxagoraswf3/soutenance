<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191212170939 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE commande_coating (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, resine INT NOT NULL, application VARCHAR(255) NOT NULL, formulation INT NOT NULL, provenance INT NOT NULL, quantite INT NOT NULL, complement LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, autrefonction LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_coating_fonction (commande_coating_id INT NOT NULL, fonction_id INT NOT NULL, INDEX IDX_2FD80991F02CA5AD (commande_coating_id), INDEX IDX_2FD8099157889920 (fonction_id), PRIMARY KEY(commande_coating_id, fonction_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_coating_fonction ADD CONSTRAINT FK_2FD80991F02CA5AD FOREIGN KEY (commande_coating_id) REFERENCES commande_coating (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_coating_fonction ADD CONSTRAINT FK_2FD8099157889920 FOREIGN KEY (fonction_id) REFERENCES fonction (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE function_thermoplastique');
        $this->addSql('DROP TABLE prenom');
        $this->addSql('ALTER TABLE commande ADD autrefonction LONGTEXT DEFAULT NULL, DROP created_at, CHANGE complement complement VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commande_coating_fonction DROP FOREIGN KEY FK_2FD80991F02CA5AD');
        $this->addSql('CREATE TABLE function_thermoplastique (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, actif TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE prenom (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE commande_coating');
        $this->addSql('DROP TABLE commande_coating_fonction');
        $this->addSql('ALTER TABLE commande ADD created_at DATETIME NOT NULL, DROP autrefonction, CHANGE complement complement LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
