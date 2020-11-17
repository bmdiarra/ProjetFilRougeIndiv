<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201116140858 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profil DROP FOREIGN KEY FK_E6D6B29725DD318D');
        $this->addSql('ALTER TABLE profil DROP FOREIGN KEY FK_E6D6B29767B3B43D');
        $this->addSql('DROP INDEX IDX_E6D6B29725DD318D ON profil');
        $this->addSql('DROP INDEX IDX_E6D6B29767B3B43D ON profil');
        $this->addSql('ALTER TABLE profil ADD libelle VARCHAR(255) NOT NULL, DROP libelle_id, DROP users_id');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677 ON user');
        $this->addSql('ALTER TABLE user CHANGE username login VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649AA08CB10 ON user (login)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profil ADD libelle_id INT DEFAULT NULL, ADD users_id INT DEFAULT NULL, DROP libelle');
        $this->addSql('ALTER TABLE profil ADD CONSTRAINT FK_E6D6B29725DD318D FOREIGN KEY (libelle_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE profil ADD CONSTRAINT FK_E6D6B29767B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_E6D6B29725DD318D ON profil (libelle_id)');
        $this->addSql('CREATE INDEX IDX_E6D6B29767B3B43D ON profil (users_id)');
        $this->addSql('DROP INDEX UNIQ_8D93D649AA08CB10 ON user');
        $this->addSql('ALTER TABLE user CHANGE login username VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
    }
}
