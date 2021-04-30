<?php

namespace Controller;

use Model\DocumentModel;
use Model\EmployeCourseModel;
use Model\EmployeDocumentModel;
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
        $notificationsResult = $NotModel->getNotifications();

        $NotEmailModel = new NotificationEmailModel();
        $emailList = $NotEmailModel->findBy([
            ["notification_type", NotificationEmailModel::EQUAL, "VEHICLE_STATUS"]
        ]);
        $emails = [];
        foreach ($emailList as $email) {
            $emails[] = $email["email"];
        }
        $content = $this->renderEmail("mail/reminder", ["documents" => $documentsResult, "maintaince" => $maintanceResult, "oilchanges" => $oilResult, "notificationsResult" => $notificationsResult]);
        $title = "Recordatorios de estado de vehiculos";
        $mailer->sendMail($emails, $title, $content);
        die;
    }

    public function sendreminderemployeAction($params = [])
    {
        set_time_limit(0);
        if ($params["params"][2] != md5($_ENV["SITE_HASH"])) {
            throw new \Exception("Acceso no autorizado", 403);
        }

        $dateFilter = date("Y-m-d");
        $mailer = new MailService();

        $EmployeDocumentModel = new EmployeDocumentModel();
        $documentsResultT = $EmployeDocumentModel->findBy([
            ["expiration_date", EmployeDocumentModel::LTE, date('Y-m-d', strtotime($dateFilter . '+ 1 month'))]
        ]);
        $documentsResult = [];
        $docsRenewaled = [];
        foreach ($documentsResultT as  $mto) {
            if (strtotime($mto["expiration_date"] . " -30 days") < time() && !in_array($mto["course_name"], $docsRenewaled)) {
                $documentsResult[] = $mto;
            } else {
                $docsRenewaled[] = $mto["course_name"];
            }
        }

        $EmployeCourseModel = new EmployeCourseModel();
        $courseResultT = $EmployeCourseModel->findBy([
            ["expiration_date", EmployeCourseModel::LTE, date('Y-m-d', strtotime($dateFilter . '+ 1 month'))]
        ]);
        $courseResult = [];
        $courseRenewaled = [];
        foreach ($courseResultT as  $mto) {
            if (strtotime($mto["expiration_date"] . " -30 days") < time() && !in_array($mto["course_name"], $courseRenewaled)) {
                $courseResult[] = $mto;
            } else {
                $courseRenewaled[] = $mto["course_name"];
            }
        }

        $NotEmailModel = new NotificationEmailModel();
        $emailList = $NotEmailModel->findBy([
            ["notification_type", NotificationEmailModel::EQUAL, "EMPLOYE_STATUS"]
        ]);
        $emails = [];
        foreach ($emailList as $email) {
            $emails[] = $email["email"];
        }
        $content = $this->renderEmail("mail/reminderemploye", ["documents" => $documentsResult, "courses" => $courseResult]);
        $title = "Recordatorios de estado de Trabajadores";
        $mailer->sendMail($emails, $title, $content);
        die;
    }
}
