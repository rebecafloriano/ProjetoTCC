<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use App\Models\UserAppointment;
use App\Models\UserFavorite;
//use App\Models\Doctor;
use App\Models\ServicePhotos;
use App\Models\Services;
use App\Models\ServiceTestimonials;
use App\Models\ServiceAvailability;


class DoctorController extends Controller
{

    private $loggedUser;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->loggedUser = auth()->user();
    }

    // ROTA QUE ADICIONA UM SERVIÇO SE ELE AINDA NÃO EXISTE
    public function addService(Request $request)
    {
        $array = ['error' => ''];

        $name = $request->input('name');
        $price = $request->input('price');
        $avatar = $request->input('avatar');

        $serviceExists = Services::where('name', $name)->count();
        if ($serviceExists === 0) {


            $newService = new Services();
            $newService->name = $name;
            $newService->avatar = $avatar . '.png';
            $newService->stars = 2;
            $newService->price = $price;
            $newService->save();

            $ns = rand(3, 6);

            for ($w = 0; $w < 4; $w++) {
                $newServicePhoto = new ServicePhotos();
                $newServicePhoto->id_service = $newService->id;
                $newServicePhoto->url = rand(1, 4) . '.png';
                $newServicePhoto->save();
            }
        } else {
            $array['error'] = 'Especialidade já existe';
        }




        return $array;
    }
    // ROTA QUE EDITA ESPECIALIDADE
    public function updateService(Request $request, $id)
    {
        $array = ['error' => ''];

        $price = $request->input('price');
        $stars = $request->input('stars');
        $avatar = $request->input('avatar');


        $service = Services::find($id);


        if ($service) {

            if ($price) {
                $service->price = $price;
            }
            if ($avatar) {
                $service->avatar = $avatar . '.png';
            }

            if ($stars) {
                $service->stars = $stars;
            }

            $service->save();
        } else {
            $array['error'] = 'Especialidade não existe';
        }
        return $array;
    }


    // ADICIONADO DIA E HORA PARA Especialidade
    public function addHorario(Request $request)
    {
        $array = ['error' => ''];


        $idService = $request->input('idService');
        $weekday = $request->input('weekday');
        $hours = $request->input('hours');


        $weekdayExists = ServiceAvailability::where('weekday', $weekday)
            ->where('id_service', $idService)->count();
        $serviceExists = Services::where('id', $idService)->count();


        // retirando os espaços em branco
        $hoursSpace = str_replace(' ', '', $hours);

        // transformando a string em array separada pela vírgula
        $infoHours = explode(',', $hoursSpace);

        // retirando do array os valores repetidos
        $infoHours = array_unique($infoHours);

        // transformando o array em string outra vez
        $infoHours = implode(",", $infoHours);
        var_dump($infoHours);

        if ($serviceExists > 0) {
            if ($weekdayExists === 0) {
                $newServiceAvail = new ServiceAvailability();
                $newServiceAvail->id_service = $idService;
                $newServiceAvail->weekday = $weekday;
                $newServiceAvail->hours = $infoHours;
                $newServiceAvail->save();
            } else {
                $array['error'] = 'Dia da semana já existe';
            }
        } else {
            $array['error'] = 'Especialidade não existe';
        }

        return $array;
    }

    // ROTA QUE EDITA HORÁRIO DA WEEKDAY, ENVIO O $ID DO WEEKDAY
    public function updateHorario(Request $request, $id)
    {
        $array = ['error' => ''];

        $rules = [

            'hours' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $array['error'] = $validator->messages();
            return $array;
        }


        $hours = $request->input('hours');

        $upService = ServiceAvailability::find($id);


        // retirando os espaços em branco
        $hoursSpace = str_replace(' ', '', $hours);

        // transformando a string em array separada pela vírgula
        $infoHours = explode(',', $hoursSpace);

        // retirando do array os valores repetidos
        $infoHours = array_unique($infoHours);

        // transformando o array em string outra vez
        $infoHours = implode(",", $infoHours);
        var_dump($infoHours);



        $upService->hours = $infoHours;
        $upService->save();



        return $array;
    }


    /*private function searchGeo($address)
    {
        $key = env('MAPS_KEY', null);

        $address = urlencode($address);

        $url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . $address . '&key=' . $key;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);
        curl_close($ch);

        return json_decode($res, true);
    }*/

    public function list(Request $request)
    {
        $array = ['error' => ''];

        /* $lat = $request->input('lat');
        $lng = $request->input('lng');
        $city = $request->input('city');
        $offset = $request->input('offset');
        if (!$offset) {
            $offset = 0;
        }

        if (!empty($city)) {
            $res = $this->searchGeo($city);

            if (count($res['results']) > 0) {
                $lat = $res['results'][0]['geometry']['location']['lat'];
                $lng = $res['results'][0]['geometry']['location']['lng'];
            }
        } elseif (!empty($lat) && !empty($lng)) {
            $res = $this->searchGeo($lat . ',' . $lng);

            if (count($res['results']) > 0) {
                $city = $res['results'][0]['formatted_address'];
            }
        } else {
            $lat = '-23.5630907';
            $lng = '-46.6682795';
            $city = 'São Paulo';
        }*/


        $services = Services::orderBy('name', 'asc')->get();

        foreach ($services as $bkey => $bvalue) {
            $services[$bkey]['avatar'] = url('media/avatars/' . $services[$bkey]['avatar']);
        }

        $array['data'] = $services;


        return $array;
    }

    /*public function getDoctors()
    {
        $array = ['error' => '', 'list' => []];

        $services = Services::All();


        $array['list'] = $services;


        return $array;
    }*/

    public function one($id)
    {
        $array = ['error' => ''];

        $service = Services::find($id);

        if ($service) {
            $service['avatar'] = url('media/avatars/' . $service['avatar']);
            $service['favorited'] = false;
            $service['photos'] = [];
            $service['services'] = [];
            $service['testimonials'] = [];
            $service['available'] = [];

            // Verificando FAVORITO
            $cFavorite = UserFavorite::where('id_user', $this->loggedUser->id)
                ->where('id_service', $service->id)
                ->count();
            if ($cFavorite > 0) {
                $service['Favorited'] = true;
            }

            // Pegando as fotos do Médico
            $service['photos'] = ServicePhotos::select('id', 'url')->where('id_service', $service->id)->get();
            foreach ($service['photos'] as $bpkey => $bpvalue) {
                $service['photos'][$bpkey]['url'] = url('media/uploads/' . $service['photos'][$bpkey]['url']);
            }

            // Pegando os serviços do Médico

            // Pegando os depoimentos do Médico
            $service['testimonials'] = ServiceTestimonials::select(['id', 'name', 'rate', 'body'])->where('id_service', $service->id)->get();

            // Pegando disponilidade do Médico
            $availability = [];

            // - Pegando a disponibilidade crua
            $avails = ServiceAvailability::where('id_service', $service->id)->get();
            $availWeekdays = [];

            foreach ($avails as $item) {
                $availWeekdays[$item['weekday']] = explode(',', $item['hours']);
            }


            // - Pegar os agendamentos dos próximos 20 dias
            $appointments = [];
            $appQuery = UserAppointment::where('id_service', $service->id)
                ->whereBetween('ap_datetime', [
                    date('Y-m-d') . '00:00:00',
                    date('Y-m-d', strtotime('+30 days')) . '23:59:59'
                ])
                ->get();
            foreach ($appQuery as $appItem) {
                $appointments[] = $appItem['ap_datetime'];
            }

            // - Gerar disponibilidade real
            for ($q = 0; $q < 20; $q++) {
                // modifiquei aqui $q+1 para exibir disponilidade para o dia seguinte
                $timeItem = strtotime('+' . $q + 1 . 'days');
                $weekday = date('w', $timeItem);

                if (in_array($weekday, array_keys($availWeekdays))) {
                    $hours = [];

                    $dayItem = date('Y-m-d', $timeItem);

                    foreach ($availWeekdays[$weekday] as $hourItem) {
                        $dayFormated = $dayItem . ' ' . $hourItem . ':00';
                        if (!in_array($dayFormated, $appointments)) {
                            $hours[] = $hourItem;
                        }
                    }

                    if (count($hours) > 0) {
                        $availability[] = [
                            'date' => $dayItem,
                            'hours' => $hours
                        ];
                    }
                }
            }

            $service['available'] = $availability;

            $array['data'] = $service;
        } else {
            $array['error'] = 'Médico não encontrado';
            return $array;
        }
        return $array;
    }

    public function setAppointment($id, Request $request)
    {
        // service, yarn, month, day, hour
        $array = ['error' => ''];

        $service = $request->input('service');
        $year = intval($request->input('year'));
        $month = intval($request->input('month'));
        $day = intval($request->input('day'));
        $hour = intval($request->input('hour'));

        $month = ($month < 10) ? '0' . $month : $month;
        $day = ($day < 10) ? '0' . $day : $day;
        $hour = ($hour < 10) ? '0' . $hour : $hour;

        // 1. verificar se o serviço do médico existe
        $service = Services::all();

        if ($service) {
            // 2. verificar se a data é real
            $apDate = $year . '-' . $month . '-' . $day . ' ' . $hour . ':00:00';
            if (strtotime($apDate) > 0) {
                if ($apDate > now()) {
                    // 3. verificar se o médico já possui agendamento neste dia/hora
                    $apps = UserAppointment::select()
                        ->where('id_service', $id)
                        ->where('ap_datetime', $apDate)
                        ->count();
                    if ($apps === 0) {
                        // 4.1 verificar se o médico atende nesta data
                        $weekday = date('w', strtotime($apDate));
                        $avail = ServiceAvailability::select()
                            ->where('id_service', $id)
                            ->where('weekday', $weekday)
                            ->first();
                        if ($avail) {
                            // 4.2 verificar se o médico atende nesta hora
                            $hours = explode(',', $avail['hours']);
                            if (in_array($hour . ':00', $hours)) {
                                // 5. fazer o agendamento
                                $newApp = new UserAppointment();
                                $newApp->id_user = $this->loggedUser->id;
                                $newApp->id_service = $id;
                                //$newApp->id_service = $service;
                                $newApp->ap_datetime = $apDate;
                                $newApp->save();
                            } else {
                                $array['error'] = 'Médico não atende nesta hora!';
                            }
                        } else {
                            $array['error'] = 'Médico não atende neste dia!';
                        }
                    } else {
                        $array['error'] = 'Data indisponível!';
                    }
                } else {
                    $array['error'] = 'Horário indisponível!';
                }
            } else {
                $array['error'] = 'Data indisponível!';
            }
        } else {
            $array['error'] = 'Serviço inexistente!';
        }

        return $array;
    }


    public function deleteAppointment($id)
    {
        $array = ['error' => ''];

        $appointment = UserAppointment::find($id);


        $appointment->delete();



        return $array;
    }

    // buscar médico por especialidade - puxar o nome do id
    public function searchService(Request $request)
    {
        $array = ['error' => '', 'list' => []];

        $q = $request->input('q');

        if ($q) {

            $services = Services::select()
                ->where('name', 'LIKE', '%' . $q . '%')
                ->get();

            foreach ($services as $bkey => $service) {
                $services[$bkey]['avatar'] = url('media/avatars/' . $services[$bkey]['avatar']);
            }

            $array['list'] = $services;
        } else {
            $array['error'] = 'Digite o que está buscando!';
        }
        return $array;
    }

    // Rota que lista agendamentos da Especialidade app
    public function filterAppointments(Request $request)
    {
        $array = ['error' => ''];

        $serviceId = $request->input('service');

        $apps = UserAppointment::select()
            ->where('id_service', $serviceId)
            ->where('ap_datetime',  '>=', now())
            ->orderBy('ap_datetime', 'DESC')
            ->get();

        if ($apps) {
            foreach ($apps as $app) {

                $service = Services::find($app['id_service']);
                $service['avatar'] = url('media/avatars/' . $service['avatar']);

                // $service = serviceServices::find($app['id_service']);

                $array['list'][] = [
                    'id' => $app['id'],
                    'datetime' => $app['ap_datetime'],
                    'service' => $service['name']
                ];
            }
        }
        return $array;
    }

    public function getPacientes()
    {
        $array = ['error' => '', 'list' => []];

        $users = User::select()
            ->where('admin', 0)
            ->get();

        if ($users) {
            foreach ($users as $user) {
                $usuario = User::find($user['id']);
                $usuario['avatar'] = url('media/avatars/' . $user['avatar']);
                $array['list'][] = $usuario;
            }
        }

        return $array;
    }

    public function getAdmins()
    {
        $array = ['error' => '', 'list' => []];

        $users = User::select()
            ->where('admin', 1)
            ->get();

        if ($users) {
            foreach ($users as $user) {
                $usuario = User::find($user['id']);
                $usuario['avatar'] = url('media/avatars/' . $user['avatar']);
                $array['list'][] = $usuario;
            }
        }

        return $array;
    }

    // Rota do painel que lista agendamentos por especialidade e período(Hoje) até data final
    public function filterAppointmentsDate(Request $request)
    {
        $array = ['error' => ''];

        $serviceId = $request->input('service');
        $periodoFim = $request->input('periodoFim');

        // pegando a data do sistema(hoje)
        $periodoInicio = substr(date("Y-m-d h:i:s"), 0, 10);
        // colocando para pegar do primeiro minuto deste dia
        $periodoInicio = $periodoInicio . ' ' . '00:00:01';
        // colocando para pegar do ultimo minuto dia final
        $periodoFim = $periodoFim . ' ' . '23:59:59';

        $apps = UserAppointment::select()
            ->where('id_service', $serviceId)
            ->whereBetween('ap_datetime', [$periodoInicio, $periodoFim])
            ->orderBy('ap_datetime', 'DESC')
            ->get();

        if ($apps) {
            foreach ($apps as $app) {

                $service = Services::find($app['id_service']);
                $user = User::find($app['id_user']);

                $service['avatar'] = url('media/avatars/' . $service['avatar']);

                // $service = serviceServices::find($app['id_service']);

                $array['list'][] = [
                    'id' => $app['id'],
                    'datetime' => $app['ap_datetime'],
                    'service' => $service['name'],
                    'paciente' => $user['name']


                ];
            }
        }
        //var_dump($user['name']);
        //var_dump($periodoInicio);
        return $array;
    }
}
