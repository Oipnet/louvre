<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181207080326 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_97A0ADA3D614C7E7');
        $this->addSql('DROP INDEX IDX_97A0ADA319EB6921');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ticket AS SELECT id, client_id, price_id FROM ticket');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('CREATE TABLE ticket (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, client_id INTEGER DEFAULT NULL, price_id INTEGER NOT NULL, command_id INTEGER DEFAULT NULL, CONSTRAINT FK_97A0ADA319EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_97A0ADA3D614C7E7 FOREIGN KEY (price_id) REFERENCES price (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_97A0ADA333E1689A FOREIGN KEY (command_id) REFERENCES command (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO ticket (id, client_id, price_id) SELECT id, client_id, price_id FROM __temp__ticket');
        $this->addSql('DROP TABLE __temp__ticket');
        $this->addSql('CREATE INDEX IDX_97A0ADA3D614C7E7 ON ticket (price_id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA319EB6921 ON ticket (client_id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA333E1689A ON ticket (command_id)');
        $this->addSql('DROP INDEX IDX_8ECAEAD45D83CC1');
        $this->addSql('DROP INDEX IDX_8ECAEAD419EB6921');
        $this->addSql('CREATE TEMPORARY TABLE __temp__command AS SELECT id, client_id, state_id, visiting_day FROM command');
        $this->addSql('DROP TABLE command');
        $this->addSql('CREATE TABLE command (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, client_id INTEGER DEFAULT NULL, state_id INTEGER DEFAULT NULL, visiting_day DATE NOT NULL, CONSTRAINT FK_8ECAEAD419EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8ECAEAD45D83CC1 FOREIGN KEY (state_id) REFERENCES state (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO command (id, client_id, state_id, visiting_day) SELECT id, client_id, state_id, visiting_day FROM __temp__command');
        $this->addSql('DROP TABLE __temp__command');
        $this->addSql('CREATE INDEX IDX_8ECAEAD45D83CC1 ON command (state_id)');
        $this->addSql('CREATE INDEX IDX_8ECAEAD419EB6921 ON command (client_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_8ECAEAD419EB6921');
        $this->addSql('DROP INDEX IDX_8ECAEAD45D83CC1');
        $this->addSql('CREATE TEMPORARY TABLE __temp__command AS SELECT id, client_id, state_id, visiting_day FROM command');
        $this->addSql('DROP TABLE command');
        $this->addSql('CREATE TABLE command (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, client_id INTEGER DEFAULT NULL, state_id INTEGER DEFAULT NULL, visiting_day DATE NOT NULL)');
        $this->addSql('INSERT INTO command (id, client_id, state_id, visiting_day) SELECT id, client_id, state_id, visiting_day FROM __temp__command');
        $this->addSql('DROP TABLE __temp__command');
        $this->addSql('CREATE INDEX IDX_8ECAEAD419EB6921 ON command (client_id)');
        $this->addSql('CREATE INDEX IDX_8ECAEAD45D83CC1 ON command (state_id)');
        $this->addSql('DROP INDEX IDX_97A0ADA319EB6921');
        $this->addSql('DROP INDEX IDX_97A0ADA3D614C7E7');
        $this->addSql('DROP INDEX IDX_97A0ADA333E1689A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ticket AS SELECT id, client_id, price_id FROM ticket');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('CREATE TABLE ticket (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, client_id INTEGER DEFAULT NULL, price_id INTEGER NOT NULL)');
        $this->addSql('INSERT INTO ticket (id, client_id, price_id) SELECT id, client_id, price_id FROM __temp__ticket');
        $this->addSql('DROP TABLE __temp__ticket');
        $this->addSql('CREATE INDEX IDX_97A0ADA319EB6921 ON ticket (client_id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA3D614C7E7 ON ticket (price_id)');
    }
}
