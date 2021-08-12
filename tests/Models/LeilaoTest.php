<?php

namespace Alura\Leilao\Test\Model;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use PHPUnit\Framework\TestCase;

class LeilaoTest extends TestCase
{
    /**
     * @dataProvider geraLances
     */
    public function testLeilaoDeveReceberLances(
        int $qtdLances,
        Leilao $leilao,
        array $valores
    ) {

        static::assertCount($qtdLances, $leilao->getLances());

        foreach ($valores as $i => $valorEsperado) {
            static::assertEquals($valorEsperado, $leilao->getLances()[$i]->getValor());
        }
    }

    public function geraLances()
    {

        $maria = new Usuario('Maria');
        $joao = new Usuario('João');

        $leilaoCom2Lances = new Leilao('Fiat 147 0KM');
        $leilaoCom2Lances->recebeLance(new Lance($joao, 1000));
        $leilaoCom2Lances->recebeLance(new Lance($maria, 2000));

        $leilaoCom1Lances = new Leilao('Fiat 147 0KM');
        $leilaoCom1Lances->recebeLance(new Lance($maria, 5000));

        return [
           '2-Lances' => [2, $leilaoCom2Lances, [1000, 2000]],
            '1-Lance' => [1, $leilaoCom1Lances, [5000]]
        ];
    }
}
