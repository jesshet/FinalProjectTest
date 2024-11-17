
class Card{
	constructor(value, suit){
		this.value = value;
		this.suit = suit;
	}
	getValue(){
		let out = this.value;
		switch (this.value){
			case "J": out = 10; break;
			case "Q": out = 10; break;
			case "K": out = 10; break;
			case "A": out = 11; break;
			default: break;
		}
		return out;
	}
}

class Deck{
	constructor(){
		this.cards = [];
		for(let i = 0; i < 13; i++){
			var k;
			if(i == 0){ k = "A";
			}else if(i == 1){ k = "K";
			}else if(i == 11){ k = "Q";
			}else if(i == 12){ k = "J";
			}else{ k = i; }
			this.cards.push(new Card(k,"clubs"));
			this.cards.push(new Card(k,"diamonds"));
			this.cards.push(new Card(k,"hearts"));
			this.cards.push(new Card(k,"spades"));
		}
		this.shuffle();
	}
	draw(){
		let c = this.cards.pop();
		return c;
	}
	shuffle(){
		for (let i = this.cards.length - 1; i > 0; i--) {
		let j = Math.floor(Math.random() * (i + 1));
		[this.cards[i], this.cards[j]] = [this.cards[j], this.cards[i]];
  }
	}
}

class Player{
	constructor(name){
		this.hand = [];
		this.winFlag = 0;
		this.name = name;
	}
	draw(c){
		this.hand.push(c);
	}
	getHandValue(){
		let aceNumber = 0;
		let total = 0;
		this.hand.forEach((Card) => {
			if(Card.getValue() === 11){
				aceNumber++;
			}
			total = total + Card.getValue();
		});
		for(let i = 0; i < aceNumber; i++){
			if(total > 21){
				total -= 10;
			}
		}
		return total;
	}
	showHand(){
		var cards = document.getElementById(this.name+'Cards').children;
		setTimeout(function(){
		for (var i = 0; i < cards.length; i++){
			cards[i].classList.add('flipped');
		}},1);
		this.hand.forEach((Card) => {
			console.log(Card);
			
		});
	}
	setWinFlag(){ //Used to decide winner
		if(this.getHandValue() == 21 && this.hand.length == 2){
			this.winFlag = 22; //blackjack
		}else if(this.getHandValue() > 21){
			this.winFlag = 0; //bust
		}else{
			this.winFlag = this.getHandValue();
		}
	}
}

class PureFabricationCardDisplayClassCuzVlad{ //this class just creates divs that display the card images and populates the dealer/player hand divs with them
	displayCard(player, c){
		var card = document.createElement("div");
		card.className = "card";
		card.width = "150px";
		
		var back = document.createElement("div");
		back.className = "card-back";
		back.width = "100px";
		
		var front = document.createElement("div");
		front.className = "card-front";
		front.width = "100px";
		
		var cardFront = document.createElement("img");
		var cardBack = document.createElement("img");
		cardFront.src = "./imgs/"+c.value+"_of_"+c.suit+".png";
		cardFront.width = "100";
		cardBack.src = "./imgs/cardBack.png";
		cardBack.width = "100";
		
		back.appendChild(cardBack);
		front.appendChild(cardFront);
		card.appendChild(back);
		card.appendChild(front);
		document.getElementById(player.name+"Cards").appendChild(card);
	}
}
//controller class
class GameController{
	constructor(deck){
		this.deck = deck;
		this.renderer = new PureFabricationCardDisplayClassCuzVlad();
	}
	draw(player){
		let temp = this.deck.draw();
		player.draw(temp);
		this.displayCard(player, temp);
		this.showHand(player);
	}
	drawHidden(player){
		let temp = this.deck.draw();
		player.draw(temp);
		this.displayCard(player, temp);
	}
	displayCard(player, card){
		this.renderer.displayCard(player, card);
	}
	showHand(player){
		player.showHand();
	}
	setWinFlag(player){
		player.setWinFlag();
	}
	gameOver(bet, player, dealer){
		this.showHand(dealer);
		this.showHand(player);
		this.setWinFlag(player);
		this.setWinFlag(dealer);
		
		//set amount won/lost and return as 'bet' - originally had in a global function but can go here or wherever
		document.getElementById("hitMeBTN").disabled = true;
		document.getElementById("stayBTN").disabled = true;
		if(p1.winFlag > dealer.winFlag){
			bet = bet * 1.5;
			console.log(`You win! Congratulations!`); //these messages might be nice in a popup window like the login prompt, but with a "play again?" prompt that reloads page or goes back to home
			console.log(`You won ${bet}!`);
		}else if(p1.winFlag < dealer.winFlag){
			bet = 0;
			console.log(`You lose. Please play again!`);
		}else{
			console.log(`Push! You get your bet back.`);
		}
		return bet;
	}
}

//global variables for html buttons to access
let newGame;
let playerDraw;
let stay;

//newGameBTN Function: (also sets the other BTNs within) -- public static void main string arrrrgh
newGame = function Game(bet){
	//on newGame, swap the visible controls and clear any child nodes from dealer and player hands
	hideStartCTRLS();
	showGameBTNS();
	document.getElementById("dealerCards").innerHTML = '';
	document.getElementById("playerCards").innerHTML = '';
	
	//initialize game variables
	let p1 = new Player("player");
	let dealer = new Player("dealer");
	let deck = new Deck();
	const game = new GameController(deck);
	
	//set function for hitMeBTN
	playerDraw = function(){ 
		game.draw(p1)
		if(p1.getHandValue() > 21){
			//Player bust
			game.gameOver(bet, p1, dealer);
		}
	}
	//set function for stayBTN
	stay = function(){ 
		game.showHand(dealer);
		while(dealer.getHandValue() < 17){
			//on player stay, house plays until its time to call gameOver method
			game.draw(dealer);
		}
		game.gameOver(bet, p1, dealer);
	}
	
	//Initial card deals
	game.draw(dealer);
	setTimeout(function(){ game.drawHidden(dealer); },750);
	setTimeout(function(){ game.draw(p1); },1500);
	setTimeout(function(){
		game.draw(p1); 
		document.getElementById("hitMeBTN").disabled = false;
		document.getElementById("stayBTN").disabled = false;
	},2250);

}

//global function that calculates bet amount
function endGame(bet, p1, dealer){
	//TODO: implement money/return bet stuff
	//TODO: add label to display output of game, and disable buttons on game over
	if(p1.winFlag > dealer.winFlag){
		bet = bet * 1.5;
		console.log(`You win! Congratulations!`);
		console.log(`You won ${bet}!`);
	}else if(p1.winFlag < dealer.winFlag){
		bet = 0;
		console.log(`You lose. Please play again!`);
	}else{
		console.log(`Push! You get your bet back.`);
	}
	return bet; //TODO: ?might not be needed? need to add bet to user account balance (and subtract from on new game start) - even on a loss should add, as bet is set to 0
}



//**Code to deal with html elements etc//
//Bet Slider code:
var slider = document.getElementById("betSlider");
var output = document.getElementById("betAmountLBL");
output.innerHTML = "Bet Amount: $" + slider.value + "!"; //Display the default slider value

slider.oninput = function() {
  output.innerHTML = "Bet Amount: $" + this.value + "!";
}

function hideStartCTRLS(){ //hide the slider and new game button when game starts
	$("#betSlider").css("visibility", "hidden");
	$("#newGameBTN").css("visibility", "hidden");
}

function showGameBTNS(){ //show the hit me and stay buttons when game ends
	$("#hitMeBTN").css("visibility", "visible");
	$("#stayBTN").css("visibility", "visible");
}