<?php
/**
 * @package     RedSHOP
 * @subpackage  Page
 * @copyright   Copyright (C) 2012 - 2014 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
use SeleniumClient\By;
use SeleniumClient\SelectElement;
use SeleniumClient\WebDriver;
use SeleniumClient\WebDriverWait;
use SeleniumClient\DesiredCapabilities;
use SeleniumClient\WebElement;

/**
 * Page class for the back-end Mails Redshop.
 *
 * @package     RedShop.Test
 * @subpackage  Webdriver
 * @since       1.0
 */
class RedShopMailsManagerPage extends AdminManagerPage
{
	/**
	 * XPath string used to uniquely identify this page
	 *
	 * @var    string
	 *
	 * @since    1.0
	 */
	protected $waitForXpath = "//h2[text() = 'Mail Management']";

	/**
	 * URL used to uniquely identify this page
	 *
	 * @var    string
	 * @since  3.0
	 */
	protected $url = 'administrator/index.php?option=com_redshop&view=mail';

	/**
	 * Function to Add a Mail
	 *
	 * @param   string  $mailName     Name of the Mail
	 * @param   string  $mailSubject  Subject of the Email
	 * @param   string  $mailSection  Section of the Email
	 *
	 * @return RedShopMailsManagerPage
	 */
	public function addMail($mailName = 'Sample Mail', $mailSubject = 'Subject of Email', $mailSection = 'Ask question about product')
	{
		$elementObject = $this->driver;
		$elementObject->findElement(By::xPath("//a[@onclick=\"Joomla.submitbutton('add')\"]"))->click();
		$this->checkNoticesForEditView(get_class($this));
		$elementObject->waitForElementUntilIsPresent(By::xPath("//input[@id='mail_name']"));
		$mailNameField = $elementObject->findElement(By::xPath("//input[@id='mail_name']"));
		$mailNameField->clear();
		$mailNameField->sendKeys($mailName);
		$mailSubjectField = $elementObject->findElement(By::xPath("//input[@id='mail_subject']"));
		$mailSubjectField->clear();
		$mailSubjectField->sendKeys($mailSubject);
		$elementObject->findElement(By::xPath("//option[text() = '" . $mailSection . "']"))->click();
		$elementObject->findElement(By::xPath("//a[@onclick=\"Joomla.submitbutton('save')\"]"))->click();
		$elementObject->waitForElementUntilIsPresent(By::xPath("//input[@id='filter']"), 10);
	}

	/**
	 * Function to update an Email
	 *
	 * @param   string  $field     Field which is to be Updated
	 * @param   string  $newValue  New value of the Updated Field
	 * @param   string  $mailName  Name of the Mail which is to be updated
	 *
	 * @return RedShopMailsManagerPage
	 */
	public function editMail($field, $newValue, $mailName)
	{
		$elementObject = $this->driver;
		$searchField = $elementObject->findElement(By::xPath("//input[@id='filter']"));
		$searchField->clear();
		$searchField = $elementObject->findElement(By::xPath("//input[@id='filter']"));
		$searchField->sendKeys($mailName);
		$elementObject->findElement(By::xPath("//button[@onclick=\"this.form.submit();\"]"))->click();
		$elementObject->waitForElementUntilIsPresent(By::xPath("//tbody/tr/td[3]/a[text() = '" . $mailName . "']"), 10);
		$row = $this->getRowNumber($mailName) - 1;
		$elementObject->waitForElementUntilIsPresent(By::xPath("//input[@id='cb" . $row . "']"), 10);
		$elementObject->findElement(By::xPath("//input[@id='cb" . $row . "']"))->click();
		$elementObject->findElement(By::xPath("//li[@id='toolbar-edit']/a"))->click();
		$this->checkNoticesForEditView(get_class($this));
		$elementObject->waitForElementUntilIsPresent(By::xPath("//input[@id='mail_name']"), 10);

		switch ($field)
		{
			case "Mail Name":
				$mailNameField = $elementObject->findElement(By::xPath("//input[@id='mail_name']"));
				$mailNameField->clear();
				$mailNameField->sendKeys($newValue);
				break;
			case "Mail Subject":
				$mailSubjectField = $elementObject->findElement(By::xPath("//input[@id='mail_subject']"));
				$mailSubjectField->clear();
				$mailSubjectField->sendKeys($newValue);
				break;
			case "Mail Section":
				$elementObject->findElement(By::xPath("//option[text() = '" . $newValue . "']"))->click();
				break;
		}

		$elementObject->findElement(By::xPath("//a[@onclick=\"Joomla.submitbutton('save')\"]"))->click();
		$elementObject->waitForElementUntilIsPresent(By::xPath("//input[@id='filter']"), 10);
	}

	public function searchEmail($emailName, $functionName = 'Search')
	{
		$elementObject = $this->driver;
		$searchField = $elementObject->findElement(By::xPath("//input[@id='filter']"));
		$searchField->clear();
		$searchField->sendKeys($emailName);
		$elementObject->findElement(By::xPath("//button[@onclick=\"this.form.submit();\"]"))->click();
		sleep(5);
		$row = $this->getRowNumber($emailName) - 1;

		if ($functionName == 'Search')
		{
			$elementObject->waitForElementUntilIsPresent(By::xPath("//input[@id='cb" . $row . "']"), 10);
		}

		$arrayElement = $elementObject->findElements(By::xPath("//tbody/tr/td[3]/a[text() = '" . $emailName . "']"));

		if (count($arrayElement))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
