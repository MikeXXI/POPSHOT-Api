<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230301155207 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ressource (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(45) NOT NULL, adresse VARCHAR(255) NOT NULL, date DATE NOT NULL, auteur VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ressource_entry (ressource_id INT NOT NULL, entry_id INT NOT NULL, INDEX IDX_BFB519F4FC6CD52A (ressource_id), INDEX IDX_BFB519F4BA364942 (entry_id), PRIMARY KEY(ressource_id, entry_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ressource_entry ADD CONSTRAINT FK_BFB519F4FC6CD52A FOREIGN KEY (ressource_id) REFERENCES ressource (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ressource_entry ADD CONSTRAINT FK_BFB519F4BA364942 FOREIGN KEY (entry_id) REFERENCES entry (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ressource_entry DROP FOREIGN KEY FK_BFB519F4FC6CD52A');
        $this->addSql('ALTER TABLE ressource_entry DROP FOREIGN KEY FK_BFB519F4BA364942');
        $this->addSql('DROP TABLE ressource');
        $this->addSql('DROP TABLE ressource_entry');
    }
}
