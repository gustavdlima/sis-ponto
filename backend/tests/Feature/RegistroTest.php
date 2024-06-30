<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
// use Tests\TestCase;
use PHPUnit\Framework\TestCase;
use App\Http\Controllers\PontoController;
use App\Models\Funcionario;
use App\Models\Registro;



class RegistroTest extends TestCase
{
    private $ponto;

    protected function setUp(): void
    {
        $this->ponto = new PontoController();
    }
    public function testValidarFuncionarioComFuncionarioInvalido()
    {
        $funcionario = new Funcionario();
        $funcionario->id = 0;
        $funcionario->id_horario = 0;

        $resultado = $this->ponto->validarFuncionario($funcionario);

        $this->assertEquals(false, $resultado);
    }

    public function testValidarFuncionarioComFuncionarioValido()
    {
        $funcionario = new Funcionario();
        $funcionario->id = 1;
        $funcionario->id_horario = 1;

        $resultado = $this->ponto->validarFuncionario($funcionario);

        $this->assertEquals(true, $resultado);
    }

    public function testUltimoRegistroDoFuncionarioComFuncionarioIdNulo()
    {
        $resultado = $this->ponto->retornaUltimoRegistroDoFuncionario(null);
        $this->assertEquals(null, $resultado);
    }

   
}
