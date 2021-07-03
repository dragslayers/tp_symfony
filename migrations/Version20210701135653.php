<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210701135653 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client_beer (client_id INT NOT NULL, beer_id INT NOT NULL, INDEX IDX_896AA5CF19EB6921 (client_id), INDEX IDX_896AA5CFD0989053 (beer_id), PRIMARY KEY(client_id, beer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client_beer ADD CONSTRAINT FK_896AA5CF19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client_beer ADD CONSTRAINT FK_896AA5CFD0989053 FOREIGN KEY (beer_id) REFERENCES beer (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE beer_client');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE beer_client (beer_id INT NOT NULL, client_id INT NOT NULL, INDEX IDX_F6B3F8FD0989053 (beer_id), INDEX IDX_F6B3F8F19EB6921 (client_id), PRIMARY KEY(beer_id, client_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE beer_client ADD CONSTRAINT FK_F6B3F8F19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE beer_client ADD CONSTRAINT FK_F6B3F8FD0989053 FOREIGN KEY (beer_id) REFERENCES beer (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE client_beer');
    }
}
