<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191203091816 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commande_additif DROP FOREIGN KEY FK_BCF91AC8B0F91E26');
        $this->addSql('ALTER TABLE commande_produit DROP FOREIGN KEY FK_DF1E9E87AABEFE2C');
        $this->addSql('CREATE TABLE commande_fonction (commande_id INT NOT NULL, fonction_id INT NOT NULL, INDEX IDX_DF20CD2782EA2E54 (commande_id), INDEX IDX_DF20CD2757889920 (fonction_id), PRIMARY KEY(commande_id, fonction_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_coating (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, resine INT NOT NULL, application VARCHAR(255) NOT NULL, formulation INT NOT NULL, provenance INT NOT NULL, quantite INT NOT NULL, complement LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_coating_fonction (commande_coating_id INT NOT NULL, fonction_id INT NOT NULL, INDEX IDX_2FD80991F02CA5AD (commande_coating_id), INDEX IDX_2FD8099157889920 (fonction_id), PRIMARY KEY(commande_coating_id, fonction_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fonction (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, visible TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_fonction ADD CONSTRAINT FK_DF20CD2782EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_fonction ADD CONSTRAINT FK_DF20CD2757889920 FOREIGN KEY (fonction_id) REFERENCES fonction (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_coating_fonction ADD CONSTRAINT FK_2FD80991F02CA5AD FOREIGN KEY (commande_coating_id) REFERENCES commande_coating (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_coating_fonction ADD CONSTRAINT FK_2FD8099157889920 FOREIGN KEY (fonction_id) REFERENCES fonction (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE additif');
        $this->addSql('DROP TABLE commande_additif');
        $this->addSql('DROP TABLE commande_produit');
        $this->addSql('DROP TABLE function_thermoplastique');
        $this->addSql('DROP TABLE produit');
        $this->addSql('ALTER TABLE commande ADD polymere VARCHAR(255) NOT NULL, ADD methode VARCHAR(255) NOT NULL, ADD masterbatch INT NOT NULL, ADD mfi VARCHAR(255) NOT NULL, ADD quantite INT NOT NULL, CHANGE email mail VARCHAR(255) NOT NULL, CHANGE complements complement LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commande_coating_fonction DROP FOREIGN KEY FK_2FD80991F02CA5AD');
        $this->addSql('ALTER TABLE commande_fonction DROP FOREIGN KEY FK_DF20CD2757889920');
        $this->addSql('ALTER TABLE commande_coating_fonction DROP FOREIGN KEY FK_2FD8099157889920');
        $this->addSql('CREATE TABLE additif (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, description LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE commande_additif (id INT AUTO_INCREMENT NOT NULL, id_commande_id INT NOT NULL, id_additif_id INT NOT NULL, quantite DOUBLE PRECISION NOT NULL, INDEX IDX_BCF91AC8B0F91E26 (id_additif_id), INDEX IDX_BCF91AC89AF8E3A3 (id_commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE commande_produit (id INT AUTO_INCREMENT NOT NULL, id_commande_id INT NOT NULL, id_produit_id INT NOT NULL, quantite DOUBLE PRECISION NOT NULL, INDEX IDX_DF1E9E87AABEFE2C (id_produit_id), INDEX IDX_DF1E9E879AF8E3A3 (id_commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE function_thermoplastique (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, actif TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, description LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE commande_additif ADD CONSTRAINT FK_BCF91AC89AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE commande_additif ADD CONSTRAINT FK_BCF91AC8B0F91E26 FOREIGN KEY (id_additif_id) REFERENCES additif (id)');
        $this->addSql('ALTER TABLE commande_produit ADD CONSTRAINT FK_DF1E9E879AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE commande_produit ADD CONSTRAINT FK_DF1E9E87AABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produit (id)');
        $this->addSql('DROP TABLE commande_fonction');
        $this->addSql('DROP TABLE commande_coating');
        $this->addSql('DROP TABLE commande_coating_fonction');
        $this->addSql('DROP TABLE fonction');
        $this->addSql('ALTER TABLE commande ADD email VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP mail, DROP polymere, DROP methode, DROP masterbatch, DROP mfi, DROP quantite, CHANGE complement complements LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
