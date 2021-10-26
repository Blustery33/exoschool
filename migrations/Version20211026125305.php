<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211026125305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE loisir DROP FOREIGN KEY FK_CF3B2060EB0ED4F5');
        $this->addSql('DROP INDEX UNIQ_CF3B2060EB0ED4F5 ON loisir');
        $this->addSql('ALTER TABLE loisir CHANGE activitie_id activities_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE loisir ADD CONSTRAINT FK_CF3B20602A4DB562 FOREIGN KEY (activities_id) REFERENCES activity (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CF3B20602A4DB562 ON loisir (activities_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE loisir DROP FOREIGN KEY FK_CF3B20602A4DB562');
        $this->addSql('DROP INDEX UNIQ_CF3B20602A4DB562 ON loisir');
        $this->addSql('ALTER TABLE loisir CHANGE activities_id activitie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE loisir ADD CONSTRAINT FK_CF3B2060EB0ED4F5 FOREIGN KEY (activitie_id) REFERENCES activity (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CF3B2060EB0ED4F5 ON loisir (activitie_id)');
    }
}
