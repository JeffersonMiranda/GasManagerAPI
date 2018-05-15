<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180513235357 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cliente ADD contato_id INT DEFAULT NULL, ADD endereco_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cliente ADD CONSTRAINT FK_F41C9B25B279BE46 FOREIGN KEY (contato_id) REFERENCES contato (id)');
        $this->addSql('ALTER TABLE cliente ADD CONSTRAINT FK_F41C9B251BB76823 FOREIGN KEY (endereco_id) REFERENCES endereco (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F41C9B25B279BE46 ON cliente (contato_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F41C9B251BB76823 ON cliente (endereco_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cliente DROP FOREIGN KEY FK_F41C9B25B279BE46');
        $this->addSql('ALTER TABLE cliente DROP FOREIGN KEY FK_F41C9B251BB76823');
        $this->addSql('DROP INDEX UNIQ_F41C9B25B279BE46 ON cliente');
        $this->addSql('DROP INDEX UNIQ_F41C9B251BB76823 ON cliente');
        $this->addSql('ALTER TABLE cliente DROP contato_id, DROP endereco_id');
    }
}
