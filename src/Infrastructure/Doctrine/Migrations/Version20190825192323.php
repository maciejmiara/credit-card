<?php

declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Ramsey\Uuid\Uuid;

class Version20190825192323 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $clientId = Uuid::uuid4()->toString();
        $client2Id = Uuid::uuid4()->toString();
        $cardId = Uuid::uuid4()->toString();
        $card2Id = Uuid::uuid4()->toString();
        $card3Id = Uuid::uuid4()->toString();

        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("INSERT INTO client VALUES ('$clientId', 'Client name')");
        $this->addSql("INSERT INTO client VALUES ('$client2Id', 'Client 2 name')");
        $this->addSql("INSERT INTO credit_card VALUES ('$cardId', '$clientId', NULL, NULL)");
        $this->addSql("INSERT INTO credit_card VALUES ('$card2Id', '$clientId', NULL, NULL)");
        $this->addSql("INSERT INTO credit_card VALUES ('$card3Id', '$client2Id', NULL, NULL)");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
    }
}
