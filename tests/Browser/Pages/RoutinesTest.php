<?php

namespace Tests\Feature;

use App\Data\Repositories\Routines;
use App\Models\User;
use App\Models\Routine;
use App\Models\EventType;
use App\Models\Sector;
use App\Models\Visitor;
use App\Support\Constants;
use Carbon\Carbon;
use Livewire\Livewire;
use App\Http\Livewire\People\People;
use App\Http\Livewire\Routines\Index;
use Illuminate\Support\Facades\DB;
use Tests\DuskTestCase;
use Tests\Browser\Pages\Page;
use Faker\Factory as Faker;


class RoutinesTest extends DuskTestCase
{
    use Page;

    protected function setUp(): void
    {
        parent::setUp();
        foreach (static::$browsers as $browser) {
            $browser->driver->manage()->deleteAllCookies();
        }
    }

    protected function tearDown(): void
    {
        $this->browse(function ($browser) {
            $browser->logout();
        });
        parent::tearDown();
    }


    /**
     * Cria, edita e finaliza uma nova rotina.
     *
     * @test
     * @group CriaRotina
     * @group link
     */
    public function testGerenciarRotina()
    {
        // Cria uma nova rotina
        $this->criaRotina();

        $routine = Routine::where('status', true)->inRandomOrder()->first(); // Rotina em aberto

        // Edita a rotina (em aberto)
        $this->browse(function ($browser) use ($routine) {
            $browser
                ->visit('/routines')
                ->assertSee('Rotinas')
                ->screenshot('criou a rotina - edit')
                ->press('@manageRoutine-' . $routine['id'])
                ->type('#checkpoint_obs', str_random(15))
                // Reescrevendo a data
                ->script("document.getElementById('entranced_at').value = '" . $this->getDataRotina()->entranced_at->addDay(2) . "'");
            $browser
                ->script('document.querySelectorAll("#submitButton")[0].click();');
            $browser
                ->assertPathIs('/routines')
                ->assertSee('Rotina alterada com sucesso!');
        });

        // Finaliza a rotina
        $this->finalizaRotinaAberta();

        $this->browse(function ($browser) {
            $browser
                ->visit('/routines')
                ->assertSee('Rotinas')
                ->screenshot('rotina editada finalizada');
        });
    }


    /**
     * Adiciona, edita e deleta uma nova ocorrência a uma rotina em aberto.
     *
     * @test
     * @group AdicionaOcorrencia
     * @group link
     */
    public function testOcorrencia()
    {
        // Cria uma nova rotina
        $this->criaRotina();

        $routine = Routine::where('status', true)->inRandomOrder()->first(); // Rotina em aberto
        $occurred_at = $routine->entranced_at->format('Y-m-d H:i'); // Pega a data da rotina em aberto

        $event_type = EventType::all()->random(6)->toArray()[0];
        $sector = Sector::all()->random(6)->toArray()[0];
        $duty_user = User::all()->random(20)->toArray()[0];

        // Adiciona uma ocorrência
        $this->browse(function ($browser) use ($routine, $event_type, $sector, $duty_user, $occurred_at) {
            $browser
                ->visit('/routines')
                ->assertSee('Rotinas')
                ->screenshot('criou a rotina - ocorrencia')
                ->press('@manageRoutine-' . $routine['id'])
                ->press('@newEvent')
                ->assertPathIs('/routines' . '/' . $routine['id'] . '/events/create')
                ->press('#submitButton')
                ->assertSee('Tipo: preencha o campo corretamente.')
                ->assertSee('Plantonista: preencha o campo corretamente.')
                ->assertSee('Observações: preencha o campo corretamente.')
                ->script("document.getElementById('occurred_at').value = '{$occurred_at}'");
            $browser
                ->select('#event_type_id', $event_type['id'])
                ->select('#sector_id', $sector['id'])
                ->select('#duty_user_id', $duty_user['id'])
                ->type('#description', Faker::create()->text(50))
                ->screenshot('Ocorrencia preenchida')
                ->press('#submitButton')
                ->assertPathIs('/routines/' . $routine['id'])
                ->assertSee('Ocorrência adicionada com sucesso!');

            //Edita a ocorrência
            $browser
                ->assertPathIs('/routines/' . $routine['id']);
            $browser
                ->script("document.getElementById('editEvent').scrollIntoView();");
            $browser
                ->click('#editEvent')
                ->select('#event_type_id', $event_type['id'])
                ->select('#sector_id', $sector['id'])
                ->select('#duty_user_id', $duty_user['id'])
                ->type('#description', Faker::create()->text(500))
                ->script("document.getElementById('occurred_at').value = '" . $this->getDataRotina()->entranced_at->addDay() . "'");
            $browser
                ->screenshot('Ocorrencia editada')
                ->press('#submitButton')
                ->assertPathIs('/routines/' . $routine['id'])
                ->assertSee('Ocorrência alterada com sucesso!')
                ->screenshot('Ocorrencia editada');

            $browser
                ->script("document.getElementById('removerEvent').scrollIntoView();");
            $browser
                ->click('#removerEvent')
                ->pause(2000)
                ->click('#submitRemoverEvent')
                ->pause(2000)
                ->assertSee('Ocorrência removida com sucesso!');
        });

        // Finaliza a rotina
        $this->finalizaRotinaAberta();

    }


    /**
     * Adiciona, edita e deleta um novo visitante a uma rotina em aberto.
     *
     * @test
     * @group AdicionaVisitante
     * @group link
     */
    public function testVisitante()
    {
        $this->criaRotina();

        $routine = Routine::where('status', true)->inRandomOrder()->first(); // Rotina em aberto

        $sector = Sector::all()->random(6)->toArray()[0];
        $duty_user = User::all()->random(20)->toArray()[0];

        $this->createVistante();

            //Edita o visitante e adiciona a saída dele
            $this->browse(function ($browser) use ($routine, $sector, $duty_user) {
                $browser
                    ->script("document.getElementById('alterarVisitor').scrollIntoView();");
                $browser
                    ->click('#alterarVisitor')
                    ->select('#sector_id', $sector['id'])
                    ->select('#duty_user_id', $duty_user['id'])
                    ->type('#description', Faker::create()->text(500))
                    ->pause(1000);
                $browser
                    ->script("document.getElementById('full_name').scrollIntoView();");
                $browser
                    ->type('#full_name', Faker::create('pt_BR')->name())
                    ->type('#origin', 'origem')
                    ->screenshot('sem clear');
                //Tentativa de inserir uma data inferir à assunção
                $browser
                    ->script("document.getElementById('exited_at').value = '2000-01-30 10:30'");
                $browser
                    ->press('#submitButton')
                    ->assertSee('A Data da Saída deve ser posterior à assunção da rotina.');
                //Saída do visitante com uma data possível
                $browser
                    ->script("document.getElementById('exited_at').value = '{$this->getDataRotina()->entranced_at->addDay(2)->format('Y-m-d H:i')}'");
                $browser
                    ->screenshot('Visitante na saída')
                    ->press('#submitButton')
                    ->assertPathIs('/routines/' . $routine['id'])
                    ->assertSee('Visitante alterado/a com sucesso!');

                //Exclui o visitante
                //Garante que a exclusão está funcionando corretamente (deve ser feito com a rotina ainda em aberto)
                $browser
                    ->script("document.getElementById('removerVisitor').scrollIntoView();");
                $browser
                    ->click('#removerVisitor')
                    ->pause(2000)
                    ->click('#submitRemoverVisitor')
                    ->pause(2000)
                    ->assertSee('Visitante removido/a com sucesso!');
        });

        //Finaliza a rotina
        $this->finalizaRotinaAberta();

    }


    /**
     * Adiciona, edita e deleta uma cautela de arma.
     * Adiciona uma arma à cautela.
     * @test
     * @group AdicionaCautelaArma
     * @group link
     */
    public function testCautela()
    {
        $this->criaRotina();

        $routine = Routine::where('status', true)->inRandomOrder()->first(); // Rotina em aberto
        $entranced_at = $routine->entranced_at->format('Y-m-d H:i');

        $sector = Sector::all()->random(1)->toArray()[0];
        $duty_user = User::all()->random(1)->toArray()[0];

        //Adiciona um visitante
        $this->browse(function ($browser) use ($entranced_at, $routine, $sector, $duty_user) {
            $browser
                ->visit('/routines')
                ->assertSee('Rotinas')
                ->screenshot('criou a rotina - cautela')
                ->press('@manageRoutine-' . $routine['id'])
                ->script('document.getElementById("newVisitor").click()');
            $browser
                ->script("document.getElementById('entranced_at').value = '{$entranced_at}'");
            $browser
                ->select('#sector_id', $sector['id'])
                ->select('#duty_user_id', $duty_user['id'])
                ->type('#cpf', Faker::create('pt_BR')->cpf())
                ->click('#btn_buscar')
                ->type('#description', Faker::create()->text(50))
                ->type('#full_name', 'Pedro Alvares Cabral')
                ->type('#origin', str_random(10))
                ->press('#submitButton')
                ->assertPathIs('/routines/' . $routine['id']);
        });

        $visitorName = "PEDRO ALVARES CABRAL";

        //Cadastro da cautela
        $this->browse(function ($browser) use ($routine, $sector, $duty_user, $entranced_at, $visitorName) {
            $browser
                ->visit('/routines')
                ->assertSee('Rotinas')
                ->press('@manageRoutine-' . $routine['id'])
                ->script('document.getElementById("newCaution").click()');
            $browser
                ->press('#submitButton')
                ->assertSee('Visitante: preencha o campo corretamente.')
                ->assertSee('Tipo de Porte: preencha o campo corretamente.')
                ->assertSee('Plantonista: preencha o campo corretamente.');
            $browser
                ->script("document.getElementById('visitor_id').scrollIntoView();");

            $browser->script([
                'var visitorName = "' . $visitorName . '";
                 var selectElement = document.getElementById("visitor_id");
                 if (selectElement) {
                     var options = selectElement.options;
                     for (var i = 0; i < options.length; i++) {
                         if (options[i].text.trim() === visitorName) {
                             options[i].selected = true;
                             var event = new Event("input", { bubbles: true });
                             selectElement.dispatchEvent(event);
                             event = new Event("change", { bubbles: true });
                             selectElement.dispatchEvent(event);
                             break;
                         }
                     }
                 }
            ']);

            $browser
                ->pause(1000)
                ->script([
                    'b = document.querySelector("[id=\'certificate_type\']");',
                    'b.value=' . rand(1,2) . ';',
                    'b.dispatchEvent(new Event(\'input\'));',
                    'b.dispatchEvent(new Event(\'change\'));',
                ]);
            $browser
                ->pause(1000)
                ->script("document.getElementById('certificate_valid_until').value = '2030-01-01'");
            $browser
                ->type('#id_card', '441273312')
                ->type('#certificate_number', '123123');
            $browser
                ->script("document.getElementById('started_at').value = '" . $this->getDataRotina()->entranced_at->addDay() . "'");
            $browser
                ->select('#duty_user_id', $duty_user['id'])
                ->type('#description', Faker::create()->text(50))
                ->press('#submitButton')
                ->screenshot('Cautela preenchida')
                ->assertSee('Cautela adicionada com sucesso!');

            //Edita a cautela
            $browser
                ->visit('/routines')
                ->assertSee('Rotinas')
                ->press('@manageRoutine-' . $routine['id'])
                ->assertPathIs('/routines/' . $routine['id'])
                ->script("document.getElementById('editCautela').scrollIntoView();");
            $browser
                ->click('#editCautela');
            $browser
                ->pause(1000)
                ->script([
                    'b = document.querySelector("[id=\'certificate_type\']");',
                    'b.value=' . rand(1,2) . ';',
                    'b.dispatchEvent(new Event(\'input\'));',
                    'b.dispatchEvent(new Event(\'change\'));',
                ]);
            $browser
                ->pause(1000)
                ->script("document.getElementById('certificate_valid_until').value = '2031-01-01'");
            $browser
                ->script("document.getElementById('started_at').value = '" . $this->getDataRotina()->entranced_at->addDay(10) . "'");
            $browser
                ->type('#id_card', '368195946')
                ->type('#certificate_number', '999999')
                ->select('#duty_user_id', $duty_user['id'])
                ->type('#description', Faker::create()->text(500))
                ->press('#submitButton')
                ->assertSee('Cautela alterada com sucesso!');

            //Adiciona uma arma
            $browser
                ->visit('/routines')
                ->assertSee('Rotinas')
                ->press('@manageRoutine-' . $routine['id'])
                ->assertPathIs('/routines/' . $routine['id'])
                ->script("document.getElementById('editCautela').scrollIntoView();");
            $browser
                ->click('#editCautela');;
            $browser
                ->script("document.getElementById('newWeapon').scrollIntoView();");
            $browser
                ->click('#newWeapon')
                ->waitForText('Nova Arma')
                ->select('#weapon_type_id', rand(1, 4))
                ->type('#weapon_description', Faker::create()->text(50))
                ->type('#weapon_number', Faker::create()->randomNumber(5))
                ->type('#register_number', Faker::create()->randomNumber(5))
                ->select('#cabinet_id', rand(1, 2))
                ->select('#shelf_id', rand(1, 50))
                ->screenshot('preencheu a arma')
                ->click('#salvarWeapon');

            //Edita a arma
            $browser
                ->pause(1000)
                ->click('#editWeapon')
                ->waitForText('Alteração de Arma')
                ->select('#weapon_type_id', rand(1, 4))
                ->type('#weapon_description', Faker::create()->text(50))
                ->type('#weapon_number', Faker::create()->randomNumber(5))
                ->type('#register_number', Faker::create()->randomNumber(5))
                ->select('#cabinet_id', rand(1, 2))
                ->select('#shelf_id', rand(1, 50))
                ->screenshot('editou a arma')
                ->click('#salvarWeapon');

            //Remove a arma
            $browser
                ->visit('/routines')
                ->assertSee('Rotinas')
                ->press('@manageRoutine-' . $routine['id'])
                ->assertPathIs('/routines/' . $routine['id'])
                ->script("document.getElementById('editCautela').scrollIntoView();");
            $browser
                ->click('#editCautela');;
            $browser
                ->pause(1000)
                ->script("document.getElementById('removeWeapon').click();");
            $browser
                ->pause(1000)
                ->click('#removerWeapon');

            //Remove a cautela
            $browser
                ->visit('/routines')
                ->assertSee('Rotinas')
                ->press('@manageRoutine-' . $routine['id'])
                ->assertPathIs('/routines/' . $routine['id'])
                ->click('#removeCautela')
                ->pause(1000)
                ->click('#removerCautela')
                ->assertSee('Cautela removida com sucesso!');

            //Remover visitante
            $browser
                ->script("document.getElementById('removerVisitor').scrollIntoView();");
            $browser
                ->click('#removerVisitor')
                ->pause(2000)
                ->click('#submitRemoverVisitor')
                ->pause(2000)
                ->assertSee('Visitante removido/a com sucesso!');
        });
        $this->finalizaRotinaAberta();

    }
    /**
     * Adiciona, edita e exclui um material a uma rotina em aberto.
     *
     * @test
     * @group AdicionaMaterial
     * @group link
     */
    public function testMaterial()
    {
        $this->criaRotina();

        $routine = Routine::where('status', true)->inRandomOrder()->first(); // Rotina em aberto
        $entranced_at = $routine->entranced_at->format('Y-m-d H:i');

        $sector = Sector::all()->random(6)->toArray()[0];
        $duty_user = User::all()->random(20)->toArray()[0];

//        $stuff = DB::table('stuffs')
//            ->where('routine_id', '=', $routine['id'])
//            ->first();

        //Adiciona um novo material
        $this->browse(function ($browser) use ($routine, $sector, $duty_user, $entranced_at) {
            $browser
                ->visit('/routines')
                ->assertSee('Rotinas')
                ->screenshot('criou a rotina - material')
                ->press('@manageRoutine-' . $routine['id'])
                ->script('document.getElementById("newStuff").click()');
            $browser
                ->assertPathIs('/routines' . '/' . $routine['id'] . '/stuffs/create')
                ->press('#submitButton')
                ->assertSee('Plantonista: preencha o campo corretamente.')
                ->assertSee('Observações: preencha o campo corretamente.')
                ->select('#sector_id', $sector['id'])
                ->select('#duty_user_id', $duty_user['id'])
                ->type('#description', Faker::create()->text(50));
            $browser
                ->script("document.getElementById('entranced_at').value = '{$entranced_at}'");
            $browser
                ->screenshot('Material preenchido')
                ->press('#submitButton')
                ->assertPathIs('/routines/' . $routine['id'])
                ->assertSee('Material adicionado com sucesso!');

            //Edita o material
            $browser
                ->assertPathIs('/routines/' . $routine['id'])
                ->script("document.getElementById('editMaterial').scrollIntoView();");
            $browser
                ->pause(1000)
                ->click('#editMaterial')
                ->select('#sector_id', $sector['id'])
                ->select('#duty_user_id', $duty_user['id'])
                ->type('#description', 'descrição alterada')
                ->script("document.getElementById('entranced_at').value = '" . $this->getDataRotina()->entranced_at->addDay() . "'");
            $browser
                ->press('#submitButton')
                ->assertPathIs('/routines/' . $routine['id'])
                ->assertSee('Material alterado com sucesso!')
                ->screenshot('Material editado');

            //Exclui o material
            //Garante que a exclusão está funcionando corretamente (deve ser feito com a rotina ainda em aberto)
            $browser
                ->script("document.getElementById('removerMaterial').scrollIntoView();");
            $browser
                ->click('#removerMaterial')
                ->pause(2000)
                ->click('#submitRemoverStuff')
                ->pause(2000)
                ->assertSee('Material removido com sucesso!');
        });
        $this->finalizaRotinaAberta();

    }

}


