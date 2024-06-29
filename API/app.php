<?php
header("Content-Type: application/javascript");
?>
// JavaScript code starts here
var data = {
  headerText: "hello hello ✨",
  pText: "I'm CCBot (cute chatbot)!",
  p2Text: "Made by Angela Victoria Fruelda",
  userMessages: [],
  botMessages: [],
  botGreeting: "", // Initialize botGreeting to be dynamic
  botLoading: false,
  emotionalResponsesCount: 0,
  chatLimitReached: false
};

class App extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      ...data,
      userName: "", // Initialize userName state
      validResponseGiven: false
    };
  }

  componentDidMount() {
    // Set personalized greeting when component mounts
    const { firstName, lastName } = this.props;
    const greeting = `Oh hi! Nice to meet you ${firstName} ${lastName}. Can you send any key to continue chatting with me?`;
    this.setState({
      botGreeting: greeting
    });
  }

  updateUserMessages = newMessage => {
  const { firstName } = this.props;
  if (!newMessage) {
    return;
  }

  var updatedMessages = [...this.state.userMessages];
  var updatedBotMessages = [...this.state.botMessages];

  this.setState({
    userMessages: updatedMessages.concat(newMessage),
    botLoading: true
  });

  let botResponse = '';

  if (!this.state.userName) {
    this.setState({
      userName: newMessage,
      botMessages: updatedBotMessages.concat(`How are you feeling today? (joy, sadness, anger, fear, disgust)`),
      botLoading: false
    });
    return;
  }

  const emotionResponses = {
    joy: `Hey ${firstName}, I'm so happy to see you filled with joy! Your positivity is contagious, and it's wonderful to witness your happiness. Keep shining brightly and spreading that joy to everyone around you. Enjoy every moment of this happiness!`,
    sadness: `Dear ${firstName}, I know you're going through a tough time right now. Please take your time to process everything, and remember that this sadness won't last forever. Sending you lots of love and positive thoughts <3`,
    anger: `Hey ${firstName}, I sense you're feeling upset right now. Remember, it's okay to feel angry sometimes. Take a deep breath and try to channel that energy constructively.`,
    fear: `Hey ${firstName}, I understand you might be feeling scared right now. Just know that it's normal to feel that way sometimes. Take a moment to breathe deeply and focus on things that bring you comfort. You're stronger than your fears.`,
    disgust: `Hey ${firstName}, I sense you're feeling disgusted about something. It's okay to have those feelings—it shows you care about what's important to you.`
  };

  if (emotionResponses[newMessage]) {
    botResponse = emotionResponses[newMessage];
    this.setState({
      validResponseGiven: true,
    });
  } else if (this.state.validResponseGiven) {
    botResponse = "Your chat limit for emotions is reached. See you next time!";
    this.setState({
      chatLimitReached: true,
    });
  } else {
    botResponse = "I'm not sure how to respond to that because the girl who programmed me is dumb at javascript. Could you please tell me if you feel (joy, sadness, anger, fear, or disgust)?";
  }

  updatedBotMessages.push(botResponse);

  this.setState({
    botMessages: updatedBotMessages,
    botLoading: false
  });
};


  scrollBubble = element => {
    if (element != null) {
      element.scrollIntoView(true);
    }
  };

  showMessages = () => {
    var userMessages = this.state.userMessages;
    var botMessages = this.state.botMessages;
    var allMessages = [];

    var i = 0;
    for (; i < userMessages.length; i++) {
      if (i === userMessages.length - 1) {
        if (botMessages[i]) {
          allMessages.push(<UserBubble message={userMessages[i]} />);
          allMessages.push(
            <BotBubble message={botMessages[i]} thisRef={this.scrollBubble} />
          );
        } else {
          allMessages.push(
            <UserBubble message={userMessages[i]} thisRef={this.scrollBubble} />
          );
        }
        break;
      }
      allMessages.push(<UserBubble message={userMessages[i]} />);
      allMessages.push(<BotBubble message={botMessages[i]} />);
    }

    allMessages.unshift(
      <BotBubble
        message={this.state.botGreeting}
        thisRef={i === 0 ? this.scrollBubble : ""}
      />
    );

    return <div className="msg-container">{allMessages}</div>;
  };

  onInput = event => {
    if (event.key === "Enter") {
      var userInput = event.target.value;
      this.updateUserMessages(userInput);
      event.target.value = "";
    }

    if (event.target.value != "") {
      event.target.parentElement.style.background = 'rgba(69,58,148,0.6)';
    } else {
      event.target.parentElement.style.background = 'rgba(255, 255, 255, 0.6)';
    }
  };

  onClick = () => {
    var inp = document.getElementById("chat");
    var userInput = inp.value;
    this.updateUserMessages(userInput);
    inp.value = "";
  };

  render() {
    return (
      <div className="app-container">
        <LogoutButton /> {/* Positioned here to ensure it's at the top left */}
        <Header
          headerText={this.state.headerText}
          pText={this.state.pText}
          p2Text={this.state.p2Text}
        />
        <div className="chat-container">
          <ChatHeader />
          {this.showMessages()}
          <UserInput onInput={this.onInput} onClick={this.onClick} />
        </div>
      </div>
    );
  }
}

class UserBubble extends React.Component {
  render() {
    return (
      <div className="user-message-container" ref={this.props.thisRef}>
        <div className="chat-bubble user">
          {this.props.message}
        </div>
      </div>
    );
  }
}

class BotBubble extends React.Component {
  render() {
    return (
      <div className="bot-message-container" ref={this.props.thisRef}>
        <div className="bot-avatar" />
        <div className="chat-bubble bot">
          {this.props.message}
        </div>
      </div>
    );
  }
}

class LogoutButton extends React.Component {
  handleLogout = () => {
    window.location.href = '../API/logout.php';
  };

  render() {
    return (
      <button className="logout-button" onClick={this.handleLogout}>
        Logout
      </button>
    );
  }
}

var Header = props => {
  return (
    <div className="header">
      <div className="header-img" />
      <h1> {props.headerText} </h1>
      <h2> {props.pText} </h2>
      <p> {props.p2Text} </p>
    </div>
  );
};

var ChatHeader = props => {
  return (
    <div className="chat-header">
      <div className="dot" />
      <div className="dot" />
      <div className="dot" />
    </div>
  );
};

var UserInput = props => {
  return (
    <div className="input-container">
      <input
        id="chat"
        type="text"
        onKeyPress={props.onInput}
        placeholder="type something"
      />
      <button className="input-submit" onClick={props.onClick} />
    </div>
  );
};

// Pass firstName and lastName props from PHP variables
ReactDOM.render(
  <App firstName={firstName} lastName={lastName} />,
  document.getElementById("app")
);
