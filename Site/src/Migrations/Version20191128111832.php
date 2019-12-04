<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191128111832 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE commande_produit (id INT AUTO_INCREMENT NOT NULL, id_commande_id INT NOT NULL, id_produit_id INT NOT NULL, quantite DOUBLE PRECISION NOT NULL, INDEX IDX_DF1E9E879AF8E3A3 (id_commande_id), INDEX IDX_DF1E9E87AABEFE2C (id_produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, complements LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_additif (id INT AUTO_INCREMENT NOT NULL, id_commande_id INT NOT NULL, id_additif_id INT NOT NULL, quantite DOUBLE PRECISION NOT NULL, INDEX IDX_BCF91AC89AF8E3A3 (id_commande_id), INDEX IDX_BCF91AC8B0F91E26 (id_additif_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE additif (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_produit ADD CONSTRAINT FK_DF1E9E879AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE commande_produit ADD CONSTRAINT FK_DF1E9E87AABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE commande_additif ADD CONSTRAINT FK_BCF91AC89AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE commande_additif ADD CONSTRAINT FK_BCF91AC8B0F91E26 FOREIGN KEY (id_additif_id) REFERENCES additif (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commande_produit DROP FOREIGN KEY FK_DF1E9E87AABEFE2C');
        $this->addSql('ALTER TABLE commande_produit DROP FOREIGN KEY FK_DF1E9E879AF8E3A3');
        $this->addSql('ALTER TABLE commande_additif DROP FOREIGN KEY FK_BCF91AC89AF8E3A3');
        $this->addSql('ALTER TABLE commande_additif DROP FOREIGN KEY FK_BCF91AC8B0F91E26');
        $this->addSql('DROP TABLE commande_produit');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commande_additif');
        $this->addSql('DROP TABLE additif');
    }
}
