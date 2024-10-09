<?php

namespace App\Services\reCaptcha;

use Google\Cloud\RecaptchaEnterprise\V1\RecaptchaEnterpriseServiceClient;
use Google\Cloud\RecaptchaEnterprise\V1\Event;
use Google\Cloud\RecaptchaEnterprise\V1\Assessment;
use Google\Cloud\RecaptchaEnterprise\V1\TokenProperties\InvalidReason;

class RecaptchaEnterpriseService
{
    protected $recaptchaKey;
    protected $projectId;
    protected $client;

    public function __construct()
    {
        $this->recaptchaKey = '6Lc3azEqAAAAAJ6TYJzsQI20EY6uC4_zpbcuTd-s'; //config('services.recaptcha.key');
        $this->projectId = 'agendamento-434014';//config('services.recaptcha.project_id');
//        $this->client = new RecaptchaEnterpriseServiceClient();
    }

    public function createAssessment(string $token, string $action): array
    {
        $projectName = $this->client->projectName($this->projectId);

        // Defina as propriedades do evento que será monitorado.
        $event = (new Event())
            ->setSiteKey($this->recaptchaKey)
            ->setToken($token);

        // Crie a solicitação de avaliação.
        $assessment = (new Assessment())
            ->setEvent($event);

        try {
            $response = $this->client->createAssessment(
                $projectName,
                $assessment
            );

            // Verifique se o token é válido.
            if ($response->getTokenProperties()->getValid() == false) {
                $reason = InvalidReason::name($response->getTokenProperties()->getInvalidReason());
                return ['success' => false, 'reason' => $reason];
            }

            // Verifique se a ação esperada foi executada.
            if ($response->getTokenProperties()->getAction() == $action) {
                // Retorne a pontuação de risco
                $score = $response->getRiskAnalysis()->getScore();
                return ['success' => true, 'score' => $score];
            } else {
                return ['success' => false, 'reason' => 'Action mismatch'];
            }
        } catch (\Exception $e) {
            return ['success' => false, 'reason' => $e->getMessage()];
        }
    }
}
