<?php
declare(strict_types = 1);
namespace JWeiland\Itmedia2\Controller;

/*
 * This file is part of the package jweiland/itmedia2.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use JWeiland\Itmedia2\Configuration\ExtConf;
use TYPO3\CMS\Core\Mail\MailMessage;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Fluid\View\TemplateView;

/**
 * Controller to send an email.
 * Will be called by scheduler task.
 */
class EmailController extends ActionController
{
    /**
     * @var TemplateView
     */
    protected $view;

    /**
     * @var MailMessage
     */
    protected $mail;

    /**
     * @var ExtConf
     */
    protected $extConf;

    /**
     * @param MailMessage $mail
     */
    public function injectMail(MailMessage $mail)
    {
        $this->mail = $mail;
    }

    /**
     * @param ExtConf $extConf
     */
    public function injectExtConf(ExtConf $extConf)
    {
        $this->extConf = $extConf;
    }

    /**
     * @param string $templateFile Template to use for sending
     * @param array $assignVariables Array containing variables to replace in template
     * @param array $redirect An Array containing action, controller and maybe some more informations for redirekt after mail processing
     */
    public function sendAction(
        string $templateFile = null,
        array $assignVariables = [],
        array $redirect = []
    ) {
        if ($templateFile !== null) {
            $this->view->setTemplatePathAndFilename(
                $this->getTemplatePath() . ucfirst($templateFile)
            );
            $this->view->assignMultiple($assignVariables);

            $this->mail->setFrom($this->extConf->getEmailFromAddress(), $this->extConf->getEmailFromName());
            $this->mail->setTo($this->extConf->getEmailToAddress(), $this->extConf->getEmailToName());
            $this->mail->setSubject(LocalizationUtility::translate(lcfirst($templateFile), 'itmedia2'));
            $this->mail->setBody($this->view->render(), 'text/html');

            $this->mail->send();
        }

        $this->redirect(
            $redirect['actionName'],
            $redirect['controllerName'],
            $redirect['extensionName'],
            $redirect['arguments'],
            $redirect['pageUid'],
            $redirect['delay'],
            $redirect['statusCode']
        );
    }

    /**
     * Get template path for email templates
     *
     * @return string email template path
     */
    public function getTemplatePath(): string
    {
        $extKey = $this->controllerContext->getRequest()->getControllerExtensionKey();
        $controllerName = $this->controllerContext->getRequest()->getControllerName();
        return ExtensionManagementUtility::extPath($extKey) . 'Resources/Private/Templates/' . $controllerName . '/';
    }
}
