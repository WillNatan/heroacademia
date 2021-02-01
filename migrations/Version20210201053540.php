<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210201053540 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE heros (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, pouvoir VARCHAR(255) NOT NULL, rang VARCHAR(255) NOT NULL, INDEX IDX_1F842770A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mission (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, date_fin DATE NOT NULL, difficulte INT NOT NULL, etat VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mission_heros (mission_id INT NOT NULL, heros_id INT NOT NULL, INDEX IDX_8F12784DBE6CAE90 (mission_id), INDEX IDX_8F12784D2A05823 (heros_id), PRIMARY KEY(mission_id, heros_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE heros ADD CONSTRAINT FK_1F842770A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE mission_heros ADD CONSTRAINT FK_8F12784DBE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mission_heros ADD CONSTRAINT FK_8F12784D2A05823 FOREIGN KEY (heros_id) REFERENCES heros (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mission_heros DROP FOREIGN KEY FK_8F12784D2A05823');
        $this->addSql('ALTER TABLE mission_heros DROP FOREIGN KEY FK_8F12784DBE6CAE90');
        $this->addSql('ALTER TABLE heros DROP FOREIGN KEY FK_1F842770A76ED395');
        $this->addSql('DROP TABLE heros');
        $this->addSql('DROP TABLE mission');
        $this->addSql('DROP TABLE mission_heros');
        $this->addSql('DROP TABLE user');
    }
}
