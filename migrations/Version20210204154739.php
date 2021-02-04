<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210204154739 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B13789A882D3');
        $this->addSql('DROP INDEX IDX_DA88B13789A882D3 ON recipe');
        $this->addSql('ALTER TABLE recipe CHANGE recipe_type_id recipe_types_id INT NOT NULL');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B137F82296C9 FOREIGN KEY (recipe_types_id) REFERENCES recipe_type (id)');
        $this->addSql('CREATE INDEX IDX_DA88B137F82296C9 ON recipe (recipe_types_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B137F82296C9');
        $this->addSql('DROP INDEX IDX_DA88B137F82296C9 ON recipe');
        $this->addSql('ALTER TABLE recipe CHANGE recipe_types_id recipe_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B13789A882D3 FOREIGN KEY (recipe_type_id) REFERENCES recipe_type (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_DA88B13789A882D3 ON recipe (recipe_type_id)');
    }
}
