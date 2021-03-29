<?php

namespace Controller;

use Model\DocumentModel;
use Model\MaintainceCarModel;
use Model\NotificationEmailModel;
use Model\NotificationModel;
use Services\MailService;

class NotificationController extends Controller
{
    public function sendreminderAction($params = [])
    {
        set_time_limit(0);
        if ($params["params"][2] != md5($_ENV["SITE_HASH"])) {
            throw new \Exception("Acceso no autorizado", 403);
        }

        $dateFilter = date("Y-m-d");
        $mailer = new MailService();

        $documentModel = new DocumentModel();
        $documentsResultT = $documentModel->findBy([
            ["date_expiration", DocumentModel::LTE, date('Y-m-d', strtotime($dateFilter . '+ 1 month'))]
        ]);
        $documentsResult = [];
        $docsRenewaled = [];
        foreach ($documentsResultT as  $mto) {
            if (strtotime($mto["date_expiration"] . " -30 days") < time() && !in_array($mto["document_name"], $docsRenewaled)) {
                $documentsResult[] = $mto;
            } else {
                $docsRenewaled[] = $mto["document_name"];
            }
        }

        $MaintainceModel = new MaintainceCarModel();
        $maintanceResult = $MaintainceModel->findBy([
            ["fc.date_maintaince", MaintainceCarModel::LTE, date('Y-m-d', strtotime($dateFilter . '+ 5 days'))],
            ["fc.status", MaintainceCarModel::EQUAL, "PROGRAMADO"]
        ]);

        $NotModel = new NotificationModel();
        $oilResult = $NotModel->getOilChanges();


        $NotEmailModel = new NotificationEmailModel();
        $emailList = $NotEmailModel->findBy([
            ["notification_type", NotificationEmailModel::EQUAL, "VEHICLE_STATUS"]
        ]);
        $emails = [];
        foreach ($emailList as $email) {
            $emails[] = $email["email"];
        }
        $content = $this->renderEmail("mail/reminder", ["documents" => $documentsResult, "maintaince" => $maintanceResult, "oilchanges" => $oilResult]);
        $title = "Recordatorios de estado de vehiculos";
        $mailer->sendMail($emails, $title, $content);
        die;
    }
}
