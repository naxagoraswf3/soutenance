<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191212170716 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, polymere VARCHAR(255) NOT NULL, methode VARCHAR(255) NOT NULL, masterbatch INT NOT NULL, mfi VARCHAR(255) NOT NULL, quantite INT NOT NULL, complement VARCHAR(255) NOT NULL, autrefonction LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_fonction (commande_id INT NOT NULL, fonction_id INT NOT NULL, INDEX IDX_DF20CD2782EA2E54 (commande_id), INDEX IDX_DF20CD2757889920 (fonction_id), PRIMARY KEY(commande_id, fonction_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_coating (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, resine INT NOT NULL, application VARCHAR(255) NOT NULL, formulation INT NOT NULL, provenance INT NOT NULL, quantite INT NOT NULL, complement LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, autrefonction LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_coating_fonction (commande_coating_id INT NOT NULL, fonction_id INT NOT NULL, INDEX IDX_2FD80991F02CA5AD (commande_coating_id), INDEX IDX_2FD8099157889920 (fonction_id), PRIMARY KEY(commande_coating_id, fonction_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fonction (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, visible TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_fonction ADD CONSTRAINT FK_DF20CD2782EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_fonction ADD CONSTRAINT FK_DF20CD2757889920 FOREIGN KEY (fonction_id) REFERENCES fonction (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_coating_fonction ADD CONSTRAINT FK_2FD80991F02CA5AD FOREIGN KEY (commande_coating_id) REFERENCES commande_coating (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_coating_fonction ADD CONSTRAINT FK_2FD8099157889920 FOREIGN KEY (fonction_id) REFERENCES fonction (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commande_fonction DROP FOREIGN KEY FK_DF20CD2782EA2E54');
        $this->addSql('ALTER TABLE commande_coating_fonction DROP FOREIGN KEY FK_2FD80991F02CA5AD');
        $this->addSql('ALTER TABLE commande_fonction DROP FOREIGN KEY FK_DF20CD2757889920');
        $this->addSql('ALTER TABLE commande_coating_fonction DROP FOREIGN KEY FK_2FD8099157889920');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commande_fonction');
        $this->addSql('DROP TABLE commande_coating');
        $this->addSql('DROP TABLE commande_coating_fonction');
        $this->addSql('DROP TABLE fonction');
    }
}
