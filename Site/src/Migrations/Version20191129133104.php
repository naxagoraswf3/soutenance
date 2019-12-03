<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191129133104 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE commande_coating_fonction (commande_coating_id INT NOT NULL, fonction_id INT NOT NULL, INDEX IDX_2FD80991F02CA5AD (commande_coating_id), INDEX IDX_2FD8099157889920 (fonction_id), PRIMARY KEY(commande_coating_id, fonction_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_coating_fonction ADD CONSTRAINT FK_2FD80991F02CA5AD FOREIGN KEY (commande_coating_id) REFERENCES commande_coating (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_coating_fonction ADD CONSTRAINT FK_2FD8099157889920 FOREIGN KEY (fonction_id) REFERENCES fonction (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE commande_coating_fonction');
    }
}
