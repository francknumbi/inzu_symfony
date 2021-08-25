<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210825113736 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property_option DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE property_option DROP FOREIGN KEY FK_AB856D7A549213EC');
        $this->addSql('ALTER TABLE property_option DROP FOREIGN KEY FK_AB856D7AA7C41D6F');
        $this->addSql('ALTER TABLE property_option ADD PRIMARY KEY (property_id, option_id)');
        $this->addSql('DROP INDEX idx_ab856d7a549213ec ON property_option');
        $this->addSql('CREATE INDEX IDX_24F16FCC549213EC ON property_option (property_id)');
        $this->addSql('DROP INDEX idx_ab856d7aa7c41d6f ON property_option');
        $this->addSql('CREATE INDEX IDX_24F16FCCA7C41D6F ON property_option (option_id)');
        $this->addSql('ALTER TABLE property_option ADD CONSTRAINT FK_AB856D7A549213EC FOREIGN KEY (property_id) REFERENCES property (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE property_option ADD CONSTRAINT FK_AB856D7AA7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property_option DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE property_option DROP FOREIGN KEY FK_24F16FCC549213EC');
        $this->addSql('ALTER TABLE property_option DROP FOREIGN KEY FK_24F16FCCA7C41D6F');
        $this->addSql('ALTER TABLE property_option ADD PRIMARY KEY (option_id, property_id)');
        $this->addSql('DROP INDEX idx_24f16fcca7c41d6f ON property_option');
        $this->addSql('CREATE INDEX IDX_AB856D7AA7C41D6F ON property_option (option_id)');
        $this->addSql('DROP INDEX idx_24f16fcc549213ec ON property_option');
        $this->addSql('CREATE INDEX IDX_AB856D7A549213EC ON property_option (property_id)');
        $this->addSql('ALTER TABLE property_option ADD CONSTRAINT FK_24F16FCC549213EC FOREIGN KEY (property_id) REFERENCES property (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE property_option ADD CONSTRAINT FK_24F16FCCA7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id) ON DELETE CASCADE');
    }
}
