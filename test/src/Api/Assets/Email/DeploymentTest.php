<?php

/**
 * @file
 * Contains \Eloqua\Tests\Api\Assets\Email\DeploymentTest.
 */

namespace Eloqua\Tests\Api\Assets\Email;

use Eloqua\Tests\Api\TestCase;

class DeploymentTest extends TestCase {

  /**
   * @test
   */
  public function shouldSearchDeployments() {
    $deployment_name = 'Foo Bar';
    $expected_response = array('response');

    $api = $this->getApiMock();
    $api->expects($this->once())
      ->method('get')
      ->with('assets/email/deployments')
      ->will($this->returnValue($expected_response));

    $this->assertEquals($expected_response, $api->search($deployment_name));
  }

  /**
   * @test
   */
  public function shouldSearchDeploymentsWithOptions() {
    $deployment_name = 'Foo Bar';
    $options = array('count' => 5);
    $expected_response = array('response');

    $api = $this->getApiMock();
    $api->expects($this->once())
      ->method('get')
      ->with('assets/email/deployments', array_merge(array('search' => $deployment_name), $options))
      ->will($this->returnValue($expected_response));

    $this->assertEquals($expected_response, $api->search($deployment_name, $options));
  }

  /**
   * @test
   */
  public function shouldShowDeploymentJustId() {
    $deployment_id = 7331;
    $expected_response = array('response');

    $api = $this->getApiMock();
    $api->expects($this->once())
      ->method('get')
      ->with('assets/email/deployment/' . $deployment_id, array(
        'depth' => 'complete',
        'extensions' => null,
      ))
      ->will($this->returnValue($expected_response));

    $this->assertEquals($expected_response, $api->show($deployment_id));
  }

  /**
   * @test
   */
  public function shouldShowDeploymentWithDepth() {
    $deployment_id = 7331;
    $deployment_depth = 'minimal';
    $expected_response = array('response');

    $api = $this->getApiMock();
    $api->expects($this->once())
      ->method('get')
      ->with('assets/email/deployment/' . $deployment_id, array(
        'depth' => $deployment_depth,
        'extensions' => null,
      ))
      ->will($this->returnValue($expected_response));

    $this->assertEquals($expected_response, $api->show($deployment_id, $deployment_depth));
  }


  /**
   * @test
   */
  public function shouldShowDeploymentWithExtensions() {
    $deployment_id = 7331;
    $deployment_path = 'complete';
    $deployment_extensions = 'extension123';
    $expected_response = array('response');

    $api = $this->getApiMock();
    $api->expects($this->once())
      ->method('get')
      ->with('assets/email/deployment/' . $deployment_id, array(
        'depth' => $deployment_path,
        'extensions' => $deployment_extensions,
      ))
      ->will($this->returnValue($expected_response));

    $this->assertEquals($expected_response, $api->show($deployment_id, $deployment_path, $deployment_extensions));
  }

  /**
   * @test
   */
  public function shouldCreateDeployment() {
    $options = array(
      'name' => 'Test Deployment',
      'contacts' => array(
        array(
          'emailAddress' => 'someone@example.com',
          'id' => 123,
        ),
      ),
      'email' => array(
        'folderId' => 42,
        'emailGroupId' => 420,
        'subject' => 'Test Subject',
      ),
    );
    $expected_response = array('response');

    $api = $this->getApiMock();
    $api->expects($this->once())
      ->method('post')
      ->with('assets/email/deployment', $options)
      ->will($this->returnValue($expected_response));

    $this->assertEquals($expected_response, $api->create($options));
  }


  /**
   * @test
   * @expectedException InvalidArgumentException
   */
  public function shouldThrowExceptionWhenCreatingDeploymentWithMissingParams()
  {
    $options = array(
      'name' => 'Test Deployment',
      // options excluded here for test
      'email' => array(
        'folderId' => 42,
        'emailGroupId' => 420,
        'subject' => 'Test Subject',
      ),
    );
    $expected_response = array('response');

    $api = $this->getApiMock();
    $api->expects($this->any())
      ->method('post');

    $api->create($options);
  }

  protected function getApiClass() {
    return 'Eloqua\Api\Assets\Email\Deployment';
  }

}
