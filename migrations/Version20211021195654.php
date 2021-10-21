<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211021195654 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activity (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE loisir (id INT AUTO_INCREMENT NOT NULL, activities_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_CF3B20602A4DB562 (activities_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_loisir (user_id INT NOT NULL, loisir_id INT NOT NULL, INDEX IDX_AA693B5DA76ED395 (user_id), INDEX IDX_AA693B5DA19C359 (loisir_id), PRIMARY KEY(user_id, loisir_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE loisir ADD CONSTRAINT FK_CF3B20602A4DB562 FOREIGN KEY (activities_id) REFERENCES activity (id)');
        $this->addSql('ALTER TABLE user_loisir ADD CONSTRAINT FK_AA693B5DA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_loisir ADD CONSTRAINT FK_AA693B5DA19C359 FOREIGN KEY (loisir_id) REFERENCES loisir (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE loisir DROP FOREIGN KEY FK_CF3B20602A4DB562');
        $this->addSql('ALTER TABLE user_loisir DROP FOREIGN KEY FK_AA693B5DA19C359');
        $this->addSql('ALTER TABLE user_loisir DROP FOREIGN KEY FK_AA693B5DA76ED395');
        $this->addSql('DROP TABLE activity');
        $this->addSql('DROP TABLE loisir');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_loisir');
    }
}
