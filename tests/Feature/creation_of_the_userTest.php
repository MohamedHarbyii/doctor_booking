<?php

use App\Models\User;
use App\Services\DatabaseServices\UserDB;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('creation of the user', function () {
    $userDb = new UserDB();

    $data = [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => bcrypt('password123'),
    ];

    $user = $userDb->create($data);

    expect($user)->toBeInstanceOf(User::class);
    expect($user->name)->toBe('John Doe');
    expect($user->email)->toBe('john@example.com');
    expect($user->id)->toBeGreaterThan(0);
});

test('get user by id', function () {
    $userDb = new UserDB;

    $user = User::factory()->create(['name' => 'Jane Doe']);

    $retrieved = $userDb->getById($user->id);

    expect($retrieved)->toBeInstanceOf(User::class);
    expect($retrieved->id)->toBe($user->id);
    expect($retrieved->name)->toBe('Jane Doe');
});

test('get user by id returns null if not found', function () {
    $userDb = new UserDB;

    $retrieved = $userDb->getById(9999);

    expect($retrieved)->toBeNull();
});

test('get all users', function () {
    $userDb = new UserDB;

    User::factory(3)->create();

    $users = $userDb->getAll();

    expect($users)->toHaveCount(3);
});

test('update user', function () {
    $userDb = new UserDB;

    $user = User::factory()->create(['name' => 'Old Name']);

    $updated = $userDb->update($user, ['name' => 'New Name']);

    expect($updated)->toBeInstanceOf(User::class);
    expect($updated->name)->toBe('New Name');
    expect($user->fresh()->name)->toBe('New Name');
});

test('delete user', function () {
    $userDb = new UserDB;

    $user = User::factory()->create();
    $userId = $user->id;

    $deleted = $userDb->delete($user);

    expect($deleted)->toBeTrue();
    expect(User::find($userId))->toBeNull();
});


test('find user by email', function () {
    $userDb = new UserDB;

    $user = User::factory()->create(['email' => 'test@example.com']);

    $found = $userDb->findByEmail('test@example.com');

    expect($found)->toBeInstanceOf(User::class);
    expect($found->email)->toBe('test@example.com');
});

test('find user by email returns null if not found', function () {
    $userDb = new UserDB;

    $found = $userDb->findByEmail('nonexistent@example.com');

    expect($found)->toBeNull();
});
