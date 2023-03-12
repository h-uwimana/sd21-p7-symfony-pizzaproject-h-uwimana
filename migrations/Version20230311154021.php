<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230311154021 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD price_small NUMERIC(5, 2) NOT NULL, ADD price_meduim NUMERIC(5, 2) NOT NULL, ADD price_large NUMERIC(5, 2) NOT NULL, DROP small, DROP meduim, DROP large');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD small NUMERIC(5, 2) NOT NULL, ADD meduim NUMERIC(5, 2) NOT NULL, ADD large NUMERIC(5, 2) NOT NULL, DROP price_small, DROP price_meduim, DROP price_large');
    }
}
