MobyGamesSDK
==============

Ever wanted to interact with the Moby Games API? Well now you can! This is a simple SDK that allows you to interact with the Moby Games API. 
It is written in PHP and is very easy to use.

## Installation
Download the SDK and place it in your project. Then include the SDK in your project.

```php
// Bring the SDK into your project
use sod96\MobyGames\ApiClient;

// First you need to create a new instance of the MobyGamesSDK class. You need to pass in your API key as a parameter.
$mobyClient = new ApiClient(env('MOBY_GAMES_API_KEY'));
$result = $mobyClient->getGame(175320);

dd($result);

// $result will contain the JSON response from the API
```


## Methods
### getGame
This method allows you to get a game from the Moby Games API. You need to pass in the game ID as a parameter.

```php
//TODO
```

## License
This SDK is licensed under the MIT License. See the LICENSE file for more information.

## Contributing
If you would like to contribute to this SDK, please fork the repository and submit a pull request. I am accepting PRs for this.

## Issues
If you find any issues with this SDK, please submit an issue. I will try to fix it as soon as possible.

## Tests
There are some tests for this SDK, you need to complete the .env file with your API key and then run the tests.
EX:
```bash
MOBY_GAMES_API_KEY=moby_xxxxxxxxx
```

## Credits & Resources

* [Moby Games](http://www.mobygames.com/)
* [Moby Games API](http://www.mobygames.com/info/api)