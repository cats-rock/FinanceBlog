<?php

test('the welcome page displays the FinanceBlog hero and public navigation', function () {
    // Arrange: this page does not need any database records.

    // Act: simulate a browser making a GET request to the homepage.
    $response = $this->get('/');

    // Assert: verify the new hero and links supplied by the shared public layout.
    $response->assertOk();
    $response->assertSee('Understand money, one article at a time.');
    $response->assertSee('Browse Articles');
    $response->assertSee('Meet the Author');
    $response->assertSee('Tags');
    $response->assertSee('FinanceBlog');
});
