<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181206135712 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE price (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, label VARCHAR(255) NOT NULL, amount INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE state (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, label VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE client (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, is_reduce BOOLEAN NOT NULL, date_of_birth DATE NOT NULL, email VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE ticket (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, client_id INTEGER DEFAULT NULL, price_id INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_97A0ADA319EB6921 ON ticket (client_id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA3D614C7E7 ON ticket (price_id)');
        $this->addSql('CREATE TABLE command (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, client_id INTEGER DEFAULT NULL, state_id INTEGER DEFAULT NULL, visiting_day DATE NOT NULL)');
        $this->addSql('CREATE INDEX IDX_8ECAEAD419EB6921 ON command (client_id)');
        $this->addSql('CREATE INDEX IDX_8ECAEAD45D83CC1 ON command (state_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE price');
        $this->addSql('DROP TABLE state');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('DROP TABLE command');
    }
}
