<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210909132116 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE character_job (job_id INT NOT NULL, character_id INT NOT NULL, level INT NOT NULL, INDEX IDX_B0723B66BE04EA9 (job_id), INDEX IDX_B0723B661136BE75 (character_id), PRIMARY KEY(job_id, character_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE character_job ADD CONSTRAINT FK_B0723B66BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)');
        $this->addSql('ALTER TABLE character_job ADD CONSTRAINT FK_B0723B661136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE character_job');
    }
}
