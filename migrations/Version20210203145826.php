<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210203145826 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_DA88B137FCFA9DAE ON recipe');
        $this->addSql('ALTER TABLE recipe CHANGE difficulty_id complexity_id INT NOT NULL');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B137DAC7F446 FOREIGN KEY (complexity_id) REFERENCES complexity (id)');
        $this->addSql('CREATE INDEX IDX_DA88B137DAC7F446 ON recipe (complexity_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B137DAC7F446');
        $this->addSql('DROP INDEX IDX_DA88B137DAC7F446 ON recipe');
        $this->addSql('ALTER TABLE recipe CHANGE complexity_id difficulty_id INT NOT NULL');
        $this->addSql('CREATE INDEX IDX_DA88B137FCFA9DAE ON recipe (difficulty_id)');
    }
}
