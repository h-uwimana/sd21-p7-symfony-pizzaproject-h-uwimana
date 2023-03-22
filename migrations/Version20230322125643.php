<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230322125643 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bestelling_product (bestelling_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_D73B86FAA2E63037 (bestelling_id), INDEX IDX_D73B86FA4584665A (product_id), PRIMARY KEY(bestelling_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bestelling_product ADD CONSTRAINT FK_D73B86FAA2E63037 FOREIGN KEY (bestelling_id) REFERENCES bestelling (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bestelling_product ADD CONSTRAINT FK_D73B86FA4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bestelling_product DROP FOREIGN KEY FK_D73B86FAA2E63037');
        $this->addSql('ALTER TABLE bestelling_product DROP FOREIGN KEY FK_D73B86FA4584665A');
        $this->addSql('DROP TABLE bestelling_product');
    }
}
