<?php

test('Test welcome page content', function () {
    // Arrange: this page does not need any database records.

    // Act: simulate a browser making a GET request to the homepage.
    $response = $this->get('/');

    // Assert: verify the response, page content, and shared layout menu.
    $response->assertStatus(200);
    $response->assertSee('Hello from the welcome page');
    $response->assertSee('Home'); // Confirms the capitalized menu from SiteLayout was rendered.
});
