
const avengersNames = ['Thor', 'Cap', 'Tony Stark', 'Black Panther', 'Black Widow', 'Hulk', 'Spider-Man'];
let randomName = avengersNames[Math.floor(Math.random() * avengersNames.length)];

const main = async () => {
  /* Event handlers */

  // When a stream is added to the conference
  VoxeetSDK.conference.on('streamAdded', (participant, stream) => {
    if (stream.type === 'ScreenShare') {
      return addScreenShareNode(stream);
    }

    if (stream.getVideoTracks().length) {
      // Only add the video node if there is a video track
      addVideoNode(participant, stream);
    }

    addParticipantNode(participant);
  });

  // When a stream is updated
  VoxeetSDK.conference.on('streamUpdated', (participant, stream) => {
    if (stream.type === 'ScreenShare') return;

    if (stream.getVideoTracks().length) {
      // Only add the video node if there is a video track
      addVideoNode(participant, stream);
    } else {
      removeVideoNode(participant);
    }
  });

  // When a stream is removed from the conference
  VoxeetSDK.conference.on('streamRemoved', (participant, stream) => {
    if (stream.type === 'ScreenShare') {
      return removeScreenShareNode();
    }

    removeVideoNode(participant);
    removeParticipantNode(participant);
  });

  try {
    // Initialize the Voxeet SDK
    // Please read the documentation at:
    // https://docs.dolby.io/communications-apis/docs/initializing-javascript
    // Generate a client access token from the Dolby.io dashboard and insert into access_token variable
    let access_token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJkb2xieS5pbyIsImlhdCI6MTY4ODEzOTQyNCwic3ViIjoiNURObHA0SnpqSHJQRjFXdlVhcVVUUT09IiwiYXV0aG9yaXRpZXMiOlsiUk9MRV9DVVNUT01FUiJdLCJ0YXJnZXQiOiJzZXNzaW9uIiwib2lkIjoiYTllM2NmMGItZTRlNi00MjIxLTg3OTAtNzQ4OGNlMzhlOTRkIiwiYWlkIjoiMGVkZTNlZWMtNTM4YS00MTg4LTkxNmQtMDU1ZDBlZjBmZTI4IiwiYmlkIjoiOGEzNjlkNDM4OTAxN2JjNDAxODkwY2U2NmFlNzdlZDkiLCJleHAiOjE2ODgyMjU4MjR9.OL_7mgs30TUEFLtU7C9JAMbQAyDOU2teniOXrHLIK1_o_FLBC28NtN2psH9VyUbTUvrltvDAUn-9eqBbmCHdDw";
    VoxeetSDK.initializeToken(access_token, (isExpired) => {
      return new Promise((resolve, reject) => {
        if (isExpired) {
          reject('The access token has expired.');
        } else {
          resolve(access_token);
        }
      });
    });

    // Open a session for the user
    await VoxeetSDK.session.open({ name: randomName });

    // Initialize the UI
    initUI();
  } catch (e) {
    alert('Something went wrong : ' + e);
  }
}

main();
