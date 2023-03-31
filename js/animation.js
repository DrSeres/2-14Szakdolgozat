const lodash = _;
const { get, set, last, debounce } = lodash;
const { mapActions, mapGetters, mapMutations } = Vuex;

const store = new Vuex.Store({
  state: {
    genre: "Neo-Plasticism",
    searchResult: [],
    activeSinglePainting: {},
    imagesData: {
      Others: [],
      Surrealism: [],
      Fauvism: [],
      "Neo-Plasticism": [],
      Futurism: [],
      Cubism: [],
      Expressionism: [],
      "Les Nabis": [],
      "Art Nouveau": [],
      Pointillism: [],
      "Post-Impressionism": [],
      Impressionism: [],
      "The Barbizon School": [],
      Realism: [],
      Symbolism: [],
      Classicism: [],
      "The Pre-Raphaelite Brotherhood": [],
      Romanticism: [],
      "Academic Art": [],
      Neoclassicism: [],
      "Rococo Art": [],
      "Baroque Art": [],
      Mannerism: [],
      "The Booming Renaissance": [],
      "The Northern Renaissance": [],
      "The Early Renaissance": [],
      "Gothic Art": []
    },
    leftHiddenImagesStack: {
      Others: [],
      Surrealism: [],
      Fauvism: [],
      "Neo-Plasticism": [],
      Futurism: [],
      Cubism: [],
      Expressionism: [],
      "Les Nabis": [],
      "Art Nouveau": [],
      Pointillism: [],
      "Post-Impressionism": [],
      Impressionism: [],
      "The Barbizon School": [],
      Realism: [],
      Symbolism: [],
      Classicism: [],
      "The Pre-Raphaelite Brotherhood": [],
      Romanticism: [],
      "Academic Art": [],
      Neoclassicism: [],
      "Rococo Art": [],
      "Baroque Art": [],
      Mannerism: [],
      "The Booming Renaissance": [],
      "The Northern Renaissance": [],
      "The Early Renaissance": [],
      "Gothic Art": []
    },
    rightHiddenImagesStack: {
      Others: [],
      Surrealism: [],
      Fauvism: [],
      "Neo-Plasticism": [],
      Futurism: [],
      Cubism: [],
      Expressionism: [],
      "Les Nabis": [],
      "Art Nouveau": [],
      Pointillism: [],
      "Post-Impressionism": [],
      Impressionism: [],
      "The Barbizon School": [],
      Realism: [],
      Symbolism: [],
      Classicism: [],
      "The Pre-Raphaelite Brotherhood": [],
      Romanticism: [],
      "Academic Art": [],
      Neoclassicism: [],
      "Rococo Art": [],
      "Baroque Art": [],
      Mannerism: [],
      "The Booming Renaissance": [],
      "The Northern Renaissance": [],
      "The Early Renaissance": [],
      "Gothic Art": []
    }
  },

  mutations: {
    UPDATE_ACTIVE_SINGLE_PAINTING(state, painting) {
      state.activeSinglePainting = painting;
    },

    UPDATE_SEARCH_RESULT(state, data) {
      state.searchResult = data;
    },
    SWITCH_GENRE(state, data) {
      let { key } = data;
      state.genre = key;
    },
    INITIALIZE_IMAGES_DATA(state, data) {
      let { key, images } = data;
      state.imagesData[key] = images;
    },
    LEFT_PUSH_IMAGES_DATA(state, data) {
      let { key, images } = data;
      if (Array.isArray(state.leftHiddenImagesStack[key])) {
        images.forEach((image) => {
          state.leftHiddenImagesStack[key].unshift(image);
        });
      } else {
        throw new Error("Mutation LEFT_PUSH_IMAGES_DATA failed");
      }
    },
    RIGHT_PUSH_IMAGES_DATA(state, data) {
      let { key, images } = data;
      if (Array.isArray(state.rightHiddenImagesStack[key])) {
        images.forEach((image) => {
          state.rightHiddenImagesStack[key].unshift(image);
        });
      } else {
        throw new Error("Mutation RIGHT_PUSH_IMAGES_DATA failed");
      }
    },
    LEFT_HIDDEN_IMAGES_STACK_POP(state, data) {
      let { key } = data;
      state.leftHiddenImagesStack[key].pop();
    },
    RIGHT_HIDDEN_IMAGES_STACK_POP(state, data) {
      let { key } = data;
      state.rightHiddenImagesStack[key].pop();
    }
  },

  actions: {
    updateActiveSinglePainting({ commit }, painting) {
      commit("UPDATE_ACTIVE_SINGLE_PAINTING", painting);
    },

    async fetchSinglePainting({ commit }, data) {
      let { index } = data;
      let { data: paintingInfo } = await axios.get(
        `https://api.boost-art.net/v1/painting?index=${index}`
      );
      commit("UPDATE_ACTIVE_SINGLE_PAINTING", paintingInfo["data"][0]);
      return paintingInfo["data"][0];
    },

    async fetchSearchResult({ commit }, searchString) {
      const config = {
        method: "get",
        url: `https://api.boost-art.net/v1/search?q=${searchString}`,
        headers: {}
      };

      const response = await axios(config).catch((err) => {
        throw new Error(err);
      });

      commit("UPDATE_SEARCH_RESULT", get(response.data, "data", []));
      return "success";
    },

    clearSearchResult({ commit }) {
      commit("UPDATE_SEARCH_RESULT", []);
    },

    switchGenre({ commit }, key) {
      const payLoads = {
        key: key
      };
      commit("SWITCH_GENRE", payLoads);
    },

    initializeImagesData({ commit }, key) {
      const config = {
        method: "get",
        url: `https://api.boost-art.net/v1/paintings?style=${key}&counts=7`,
        headers: {}
      };

      return new Promise((resolve, reject) => {
        axios(config)
          .then(function (response) {
            const payLoads = {
              key: get(response.data, "style"),
              images: get(response.data, "data")
            };
            commit("INITIALIZE_IMAGES_DATA", payLoads);
            resolve("success");
            // console.log(JSON.stringify(response.data));
          })
          .catch(function (error) {
            console.log(error);
            reject(error);
          });
      });
    },

    leftPushImagesData({ commit }, key) {
      const config = {
        method: "get",
        url: `https://api.boost-art.net/v1/paintings?style=${key}&counts=5`,
        headers: {}
      };

      return new Promise((resolve, reject) => {
        axios(config)
          .then(function (response) {
            // store the last four for later use
            const payLoads = {
              key: get(response.data, "style"),
              images: get(response.data, "data").slice(0, -1)
            };

            // pop the first one for immediate rendering
            const popData = {
              key: get(response.data, "style"),
              images: get(response.data, "data").slice(-1)
            };

            commit("LEFT_PUSH_IMAGES_DATA", payLoads);
            resolve(popData);
            // console.log(JSON.stringify(response.data));
          })
          .catch(function (error) {
            console.log(error);
            reject(error);
          });
      });
    },

    rightPushImagesData({ commit }, key) {
      const config = {
        method: "get",
        url: `https://api.boost-art.net/v1/paintings?style=${key}&counts=5`,
        headers: {}
      };

      return new Promise((resolve, reject) => {
        axios(config)
          .then(function (response) {
            const payLoads = {
              key: get(response.data, "style"),
              images: get(response.data, "data").slice(0, -1)
            };

            // pop the first one for immediate rendering
            const popData = {
              key: get(response.data, "style"),
              images: get(response.data, "data").slice(-1)
            };

            commit("RIGHT_PUSH_IMAGES_DATA", payLoads);
            resolve(popData);
            // console.log(JSON.stringify(response.data));
          })
          .catch(function (error) {
            console.log(error);
            reject(error);
          });
      });
    },

    leftHiddenImagesStackPop({ commit }, key) {
      const payLoads = {
        key: key
      };
      commit("LEFT_HIDDEN_IMAGES_STACK_POP", payLoads);
    },

    rightHiddenImagesStackPop({ commit }, key) {
      const payLoads = {
        key: key
      };
      commit("RIGHT_HIDDEN_IMAGES_STACK_POP", payLoads);
    }
  },

  getters: {
    getActiveSinglePainting(state) {
      return state.activeSinglePainting;
    },
    getSearchResult(state) {
      return state.searchResult;
    },

    getGenre(state) {
      return state.genre;
    },

    getImagesData(state) {
      return state.imagesData;
    },

    getLeftHiddenImagesStack(state) {
      return state.leftHiddenImagesStack;
    },

    getRightHiddenImagesStack(state) {
      return state.rightHiddenImagesStack;
    }
  }
});

Vue.use(VueResize);

Vue.component("exhibition-container", {
  template: "#exhibition-container",
  data() {
    return {
      visible: false, // whether image previewer visible
      startPosition: 0,
      mobile: false,
      currentImageUrl:
        "https://westart101.s3-ap-southeast-1.amazonaws.com/Modigliani053.png",
      documentEvtFunc: null
    };
  },

  computed: {
    ...mapGetters({
      genre: "getGenre",
      imagesData: "getImagesData",
      leftHiddenImagesStack: "getLeftHiddenImagesStack",
      rightHiddenImagesStack: "getRightHiddenImagesStack"
    }),

    renderedImageUrls() {
      return this.imagesData[this.genre].map((el) => {
        return Object.assign(
          {},
          {
            azure_blob: el.azure_blob,
            Painter_En: el.Painter_En,
            Year: el.Year,
            Name_En: el.Name_En,
            Museum_En: el.Museum_En
          }
        );
      });
    },

    cardsContainerEl() {
      return this.$refs.cardsWrapper;
    },

    cardInfosContainerEl() {
      return this.$refs.infoWrapper;
    },

    appBgContainerEl() {
      return this.$refs.appBg;
    },

    firstPaintedDetector() {
      if (this.$refs.cardsWrapper) {
        return (
          this.$refs.cardsWrapper.lastChild.lastChild.lastChild
            .getAttribute("src")
            .slice(0, 5) === "https"
        );
      }
      return undefined;
    },

    metaInfo() {
      const paintingIndex = this.currentImageUrl
        .split("/")
        .slice(-1)[0]
        .split(".")[0];
      const url = `https://www.boost-art.net/painting/${paintingIndex}`;
      const title = `${this.genre} | Boost Art Net`;
      const description =
        "Treasure the captivating beauty from those classical Masterpieces, in a tremendous way.";
      const media = this.currentImageUrl;
      return {
        url,
        title,
        description,
        media,
        hashtags: "art"
      };
    }
  },

  watch: {
    visible(newValue) {
      if (newValue) {
        this.terminateKeyboardEvent();
      } else {
        !this.documentEvtFunc && this.registerKeyboardEvent();
      }
    }
  },

  methods: {
    ...mapActions([
      "initializeImagesData",
      "leftPushImagesData",
      "rightPushImagesData",
      "leftHiddenImagesStackPop",
      "rightHiddenImagesStackPop"
    ]),
    ...mapMutations(["LEFT_PUSH_IMAGES_DATA", "RIGHT_PUSH_IMAGES_DATA"]),

    get,
    last, // used in tempalate

    handleImgPreview(index, $event) {
      const boxClass = $event.target.classList.value;
      if (boxClass.search("current--card") > -1) {
        this.currentImageUrl = $event.target
          .querySelector(".card__image img")
          .getAttribute("src");
        this.$nextTick(() => {
          this.visible = true;
          this.startPosition = index;
        });
      }
    },

    handleSpaceTriggeredImgPreview() {
      const event = new MouseEvent("click", {
        view: window,
        bubbles: true,
        cancelable: true
      });
      const currentCardEl = this.cardsContainerEl.querySelector(
        ".current--card"
      );
      currentCardEl.dispatchEvent(event);
    },

    handleResize({ width }) {
      this.mobile = width <= 450;
      const cards = Array.from(this.cardsContainerEl.children);
      if (
        this.mobile &&
        cards.every(
          (card) => card.getAttribute("touchstartListener") !== "true"
        )
      ) {
        this.cardsContainerEl.children.forEach((card) => {
          card.setAttribute("touchstartListener", "true");
          card.addEventListener("touchstart", (e) => {
            this.touchStart(e);
          });
        });
      }
    },

    registerKeyboardEvent() {
      this.documentEvtFunc = (event) => {
        const key = event.key.toLowerCase();

        if (key === "arrowleft") {
          this.swapCards("left");
        } else if (key === "arrowright") {
          this.swapCards("right");
        } else if (key === "control") {
          this.handleSpaceTriggeredImgPreview();
        }
      };
      document.addEventListener("keydown", this.documentEvtFunc);
    },

    terminateKeyboardEvent() {
      document.removeEventListener("keydown", this.documentEvtFunc);
      this.documentEvtFunc = null;
    },

    touchStart(touchEvent) {
      if (touchEvent.changedTouches.length !== 1) {
        // We only care if one finger is used
        return;
      }
      const posXStart = touchEvent.changedTouches[0].clientX;
      addEventListener(
        "touchend",
        (touchEvent) => this.touchEnd(touchEvent, posXStart),
        { once: true }
      );
    },

    touchEnd(touchEvent, posXStart) {
      if (touchEvent.changedTouches.length !== 1) {
        // We only care if one finger is used
        return;
      }
      const posXEnd = touchEvent.changedTouches[0].clientX;
      if (posXStart < posXEnd) {
        this.swapCards("left"); // swipe left to right
      } else if (posXStart > posXEnd) {
        this.swapCards("right"); // swipe right to left
      }
    },

    initCardEvents() {
      const currentCardEl = this.cardsContainerEl.querySelector(
        ".current--card"
      );
      currentCardEl.addEventListener("pointermove", this.updateCard);
      currentCardEl.addEventListener("pointerout", (e) => {
        this.resetCardTransforms(e);
      });
    },

    resetCardTransforms(e) {
      const card = e.currentTarget;
      const currentInfoEl = this.cardInfosContainerEl.querySelector(
        ".current--info"
      );
      gsap.set(card, {
        "--current-card-rotation-offset": 0
      });
      gsap.set(currentInfoEl, {
        rotateY: 0
      });
    },

    updateCard(e) {
      const card = e.currentTarget;
      const box = card.getBoundingClientRect();
      const centerPosition = {
        x: box.left + box.width / 2,
        y: box.top + box.height / 2
      };
      let angle = Math.atan2(e.pageX - centerPosition.x, 0) * (35 / Math.PI);
      gsap.set(card, {
        "--current-card-rotation-offset": `${angle}deg`
      });
      const currentInfoEl = this.cardInfosContainerEl.querySelector(
        ".current--info"
      );
      gsap.set(currentInfoEl, {
        rotateY: `${angle}deg`
      });
    },

    removeCardEvents(card) {
      card.removeEventListener("pointermove", this.updateCard);
    },

    swapCardsClass(direction, cardsArray, bgsArray) {
      const [
        currentCardEl,
        previousCardEl,
        nextCardEl,
        leftsecondCardEl,
        leftmostCardEl,
        rightsecondCardEl,
        rightmostCardEl
      ] = cardsArray;
      const [
        currentBgImageEl,
        previousBgImageEl,
        nextBgImageEl,
        leftsecondBgImageEl,
        leftmostBgImageEl,
        rightsecondBgImageEl,
        rightmostBgImageEl
      ] = bgsArray;
      currentCardEl.classList.remove("current--card");
      previousCardEl.classList.remove("previous--card");
      nextCardEl.classList.remove("next--card");
      leftsecondCardEl.classList.remove("leftsecond--card");
      leftmostCardEl.classList.remove("leftmost--card");
      rightsecondCardEl.classList.remove("rightsecond--card");
      rightmostCardEl.classList.remove("rightmost--card");

      currentBgImageEl.classList.remove("current--image");
      previousBgImageEl.classList.remove("previous--image");
      nextBgImageEl.classList.remove("next--image");
      leftsecondBgImageEl.classList.remove("leftsecond--image");
      leftmostBgImageEl.classList.remove("leftmost--image");
      rightsecondBgImageEl.classList.remove("rightsecond--image");
      rightmostBgImageEl.classList.remove("rightmost--image");

      currentCardEl.style.zIndex = "50";
      currentBgImageEl.style.zIndex = "-2";

      if (direction === "right") {
        console.log("direction right");
        previousCardEl.style.zIndex = "20";
        nextCardEl.style.zIndex = "30";

        nextBgImageEl.style.zIndex = "-1";

        currentCardEl.style.transition = "";
        previousCardEl.style.transition = "";
        nextCardEl.style.transition = "";
        leftsecondCardEl.style.transition = "";
        leftmostCardEl.style.transition = "";
        rightsecondCardEl.style.transition = "";
        rightmostCardEl.style.transition = "";
        currentCardEl.classList.add("previous--card");
        previousCardEl.classList.add("leftsecond--card");
        nextCardEl.classList.add("current--card");
        leftsecondCardEl.classList.add("leftmost--card");
        leftmostCardEl.style.transition = "none";
        leftmostCardEl.classList.add("rightmost--card");

        rightsecondCardEl.classList.add("next--card");
        rightmostCardEl.classList.add("rightsecond--card");

        currentBgImageEl.classList.add("previous--image");
        previousBgImageEl.classList.add("leftsecond--image");
        nextBgImageEl.classList.add("current--image");
        leftsecondBgImageEl.classList.add("leftmost--image");
        leftmostBgImageEl.classList.add("rightmost--image");

        rightsecondBgImageEl.classList.add("next--image");
        rightmostBgImageEl.classList.add("rightsecond--image");
      } else if (direction === "left") {
        console.log("direction left");
        previousCardEl.style.zIndex = "30";
        nextCardEl.style.zIndex = "20";

        previousBgImageEl.style.zIndex = "-1";

        currentCardEl.style.transition = "";
        previousCardEl.style.transition = "";
        nextCardEl.style.transition = "";
        leftsecondCardEl.style.transition = "";
        leftmostCardEl.style.transition = "";
        rightsecondCardEl.style.transition = "";
        rightmostCardEl.style.transition = "";
        currentCardEl.classList.add("next--card");
        previousCardEl.classList.add("current--card");
        nextCardEl.classList.add("rightsecond--card");
        leftsecondCardEl.classList.add("previous--card");
        leftmostCardEl.classList.add("leftsecond--card");
        rightsecondCardEl.classList.add("rightmost--card");
        rightmostCardEl.style.transition = "none";
        rightmostCardEl.classList.add("leftmost--card");

        currentBgImageEl.classList.add("next--image");
        previousBgImageEl.classList.add("current--image");
        nextBgImageEl.classList.add("rightsecond--image");
        leftsecondBgImageEl.classList.add("previous--image");
        leftmostBgImageEl.classList.add("leftsecond--image");
        rightsecondBgImageEl.classList.add("rightmost--image");
        rightmostBgImageEl.classList.add("leftmost--image");
      }
    },

    swapInfosClass(direction, infosArray) {
      const [
        currentInfoEl,
        previousInfoEl,
        nextInfoEl,
        leftsecondInfoEl,
        leftmostInfoEl,
        rightsecondInfoEl,
        rightmostInfoEl
      ] = infosArray;
      currentInfoEl.classList.remove("current--info");
      previousInfoEl.classList.remove("previous--info");
      nextInfoEl.classList.remove("next--info");
      leftsecondInfoEl.classList.remove("leftsecond--info");
      leftmostInfoEl.classList.remove("leftmost--info");
      rightsecondInfoEl.classList.remove("rightsecond--info");
      rightmostInfoEl.classList.remove("rightmost--info");

      if (direction === "right") {
        currentInfoEl.classList.add("previous--info");
        nextInfoEl.classList.add("current--info");
        previousInfoEl.classList.add("leftsecond--info");
        leftsecondInfoEl.classList.add("leftmost--info");
        leftmostInfoEl.classList.add("rightmost--info");
        rightsecondInfoEl.classList.add("next--info");
        rightmostInfoEl.classList.add("rightsecond--info");
      } else if (direction === "left") {
        currentInfoEl.classList.add("next--info");
        nextInfoEl.classList.add("rightsecond--info");
        previousInfoEl.classList.add("current--info");
        leftsecondInfoEl.classList.add("previous--info");
        leftmostInfoEl.classList.add("leftsecond--info");
        rightsecondInfoEl.classList.add("rightmost--info");
        rightmostInfoEl.classList.add("leftmost--info");
      }
    },

    rerenderEdgeImageCard(direction, infosArray, cardsArray, bgsArray) {
      // console.log(direction, infosArray, cardsArray, bgsArray);
      if (direction === "right") {
        //The add-class operation should have been done in the previous changeInfo and swapCardsClass methods.
        const rightmostInfoEl = infosArray.filter(
          // Because of the asynchronous dom operation of gsap, swapInfosClass is triggered after rerenderEdgeImageCard
          (el) => el.classList.value.indexOf("leftmost--info") > -1
        )[0];
        const rightmostCardEl = cardsArray.filter(
          (el) => el.classList.value.indexOf("rightmost--card") > -1
        )[0];
        const rightmostBgImageEl = bgsArray.filter(
          (el) => el.classList.value.indexOf("rightmost--image") > -1
        )[0];
        let obj = {};
        obj["Name_En"] = rightmostInfoEl.children[0].innerText;
        obj["Year"] = rightmostInfoEl.children[1].innerText;
        obj["Painter_En"] = rightmostInfoEl.children[2].innerText;
        obj["Museum_En"] = rightmostInfoEl.children[3].innerText;
        obj["azure_blob"] = rightmostCardEl.lastChild.lastChild.getAttribute(
          "src"
        );
        // now the right most card is the previous left most card, we need to
        // to store its data for the left stack, and replace with new data.
        this.LEFT_PUSH_IMAGES_DATA({
          key: this.genre,
          images: [obj]
        });
        if (this.rightHiddenImagesStack[this.genre].length > 1) {
          // Prevent vue getter/setter initialization
          set(
            rightmostInfoEl,
            "children[0].innerText",
            this.rightHiddenImagesStack[this.genre].slice(-1)[0]["Name_En"]
          );
          set(
            rightmostInfoEl,
            "children[1].innerText",
            this.rightHiddenImagesStack[this.genre].slice(-1)[0]["Year"]
          );
          set(
            rightmostInfoEl,
            "children[2].innerText",
            this.rightHiddenImagesStack[this.genre].slice(-1)[0]["Painter_En"]
          );
          set(
            rightmostInfoEl,
            "children[3].innerText",
            this.rightHiddenImagesStack[this.genre].slice(-1)[0]["Museum_En"]
          );
          rightmostCardEl.lastChild.lastChild.setAttribute(
            "src",
            this.rightHiddenImagesStack[this.genre].slice(-1)[0]["azure_blob"]
          );
          rightmostBgImageEl.lastChild.setAttribute(
            "src",
            this.rightHiddenImagesStack[this.genre].slice(-1)[0]["azure_blob"]
          );
          this.rightHiddenImagesStackPop(this.genre);
        } else {
          this.rightPushImagesData(this.genre).then((popData) => {
            const { images: data } = popData;
            set(rightmostInfoEl, "children[0].innerText", data[0]["Name_En"]);
            set(rightmostInfoEl, "children[1].innerText", data[0]["Year"]);
            set(
              rightmostInfoEl,
              "children[2].innerText",
              data[0]["Painter_En"]
            );
            set(rightmostInfoEl, "children[3].innerText", data[0]["Museum_En"]);
            rightmostCardEl.lastChild.lastChild.setAttribute(
              "src",
              data[0]["azure_blob"]
            );
            rightmostBgImageEl.lastChild.setAttribute(
              "src",
              data[0]["azure_blob"]
            );
          });
        }
      } else if (direction === "left") {
        //The add-class operation should have been done in the previous changeInfo and swapCardsClass methods.
        const leftmostInfoEl = infosArray.filter(
          // Because of the asynchronous dom operation of gsap, swapInfosClass is triggered after rerenderEdgeImageCard
          (el) => el.classList.value.indexOf("rightmost--info") > -1
        )[0];
        const leftmostCardEl = cardsArray.filter(
          (el) => el.classList.value.indexOf("leftmost--card") > -1
        )[0];
        const leftmostBgImageEl = bgsArray.filter(
          (el) => el.classList.value.indexOf("leftmost--image") > -1
        )[0];
        let obj = {};
        obj["Name_En"] = leftmostInfoEl.children[0].innerText;
        obj["Year"] = leftmostInfoEl.children[1].innerText;
        obj["Painter_En"] = leftmostInfoEl.children[2].innerText;
        obj["Museum_En"] = leftmostInfoEl.children[3].innerText;
        obj["azure_blob"] = leftmostCardEl.lastChild.lastChild.getAttribute(
          "src"
        );
        // now the right most card is the previous left most card, we need to
        // to store its data for the left stack, and replace with new data.
        this.RIGHT_PUSH_IMAGES_DATA({
          key: this.genre,
          images: [obj]
        });
        if (this.leftHiddenImagesStack[this.genre].length > 1) {
          // Prevent vue getter/setter initialization
          set(
            leftmostInfoEl,
            "children[0].innerText",
            this.leftHiddenImagesStack[this.genre].slice(-1)[0]["Name_En"]
          );
          set(
            leftmostInfoEl,
            "children[1].innerText",
            this.leftHiddenImagesStack[this.genre].slice(-1)[0]["Year"]
          );
          set(
            leftmostInfoEl,
            "children[2].innerText",
            this.leftHiddenImagesStack[this.genre].slice(-1)[0]["Painter_En"]
          );
          set(
            leftmostInfoEl,
            "children[3].innerText",
            this.leftHiddenImagesStack[this.genre].slice(-1)[0]["Museum_En"]
          );
          leftmostCardEl.lastChild.lastChild.setAttribute(
            "src",
            this.leftHiddenImagesStack[this.genre].slice(-1)[0]["azure_blob"]
          );
          leftmostBgImageEl.lastChild.setAttribute(
            "src",
            this.leftHiddenImagesStack[this.genre].slice(-1)[0]["azure_blob"]
          );
          this.leftHiddenImagesStackPop(this.genre);
        } else {
          this.leftPushImagesData(this.genre).then((popData) => {
            const { images: data } = popData;
            set(leftmostInfoEl, "children[0].innerText", data[0]["Name_En"]);
            set(leftmostInfoEl, "children[1].innerText", data[0]["Year"]);
            set(leftmostInfoEl, "children[2].innerText", data[0]["Painter_En"]);
            set(leftmostInfoEl, "children[3].innerText", data[0]["Museum_En"]);
            leftmostCardEl.lastChild.lastChild.setAttribute(
              "src",
              data[0]["azure_blob"]
            );
            leftmostBgImageEl.lastChild.setAttribute(
              "src",
              data[0]["azure_blob"]
            );
          });
        }
      }
    },

    changeInfo(direction, buttons, infosArray) {
      const [currentInfoEl, previousInfoEl, nextInfoEl] = infosArray;
      // the gsap timeline seems to work asynchronously at dom operation. Hence swapInfosClass is
      // triggered after rerenderEdgeImageCard
      gsap
        .timeline()
        .to([buttons.prev, buttons.next], {
          duration: 0.2,
          opacity: 0.5,
          pointerEvents: "none"
        })
        .to(
          currentInfoEl.querySelectorAll(".text"),
          {
            duration: 0.4,
            stagger: 0.1,
            translateY: "-120px",
            opacity: 0
          },
          "-="
        )
        .call(() => {
          this.swapInfosClass(direction, infosArray);
        })
        .call(() => this.initCardEvents())
        .fromTo(
          direction === "right"
            ? nextInfoEl.querySelectorAll(".text")
            : previousInfoEl.querySelectorAll(".text"),
          {
            opacity: 0,
            translateY: "40px"
          },
          {
            duration: 0.4,
            stagger: 0.1,
            translateY: "0px",
            opacity: 1
          }
        )
        .to([buttons.prev, buttons.next], {
          duration: 0.2,
          opacity: 1,
          pointerEvents: "all"
        });
    },

    swapCards: debounce(
      function (direction) {
        const {
          cardsContainerEl,
          appBgContainerEl,
          cardInfosContainerEl
        } = this;
        this.$nextTick(() => {
          const buttons = {
            prev: document.querySelector(".btn--left"),
            next: document.querySelector(".btn--right")
          };
          const currentCardEl = cardsContainerEl.querySelector(
            ".current--card"
          );
          const previousCardEl = cardsContainerEl.querySelector(
            ".previous--card"
          );
          const nextCardEl = cardsContainerEl.querySelector(".next--card");
          const leftsecondCardEl = cardsContainerEl.querySelector(
            ".leftsecond--card"
          );
          const leftmostCardEl = cardsContainerEl.querySelector(
            ".leftmost--card"
          );
          const rightsecondCardEl = cardsContainerEl.querySelector(
            ".rightsecond--card"
          );
          const rightmostCardEl = cardsContainerEl.querySelector(
            ".rightmost--card"
          );

          const currentBgImageEl = appBgContainerEl.querySelector(
            ".current--image"
          );
          const previousBgImageEl = appBgContainerEl.querySelector(
            ".previous--image"
          );
          const nextBgImageEl = appBgContainerEl.querySelector(".next--image");
          const leftsecondBgImageEl = appBgContainerEl.querySelector(
            ".leftsecond--image"
          );
          const leftmostBgImageEl = appBgContainerEl.querySelector(
            ".leftmost--image"
          );
          const rightsecondBgImageEl = appBgContainerEl.querySelector(
            ".rightsecond--image"
          );
          const rightmostBgImageEl = appBgContainerEl.querySelector(
            ".rightmost--image"
          );

          const currentInfoEl = cardInfosContainerEl.querySelector(
            ".current--info"
          );
          const previousInfoEl = cardInfosContainerEl.querySelector(
            ".previous--info"
          );
          const nextInfoEl = cardInfosContainerEl.querySelector(".next--info");
          const leftsecondInfoEl = cardInfosContainerEl.querySelector(
            ".leftsecond--info"
          );
          const leftmostInfoEl = cardInfosContainerEl.querySelector(
            ".leftmost--info"
          );
          const rightsecondInfoEl = cardInfosContainerEl.querySelector(
            ".rightsecond--info"
          );
          const rightmostInfoEl = cardInfosContainerEl.querySelector(
            ".rightmost--info"
          );

          const cardsArray = [
            currentCardEl,
            previousCardEl,
            nextCardEl,
            leftsecondCardEl,
            leftmostCardEl,
            rightsecondCardEl,
            rightmostCardEl
          ];
          const bgsArray = [
            currentBgImageEl,
            previousBgImageEl,
            nextBgImageEl,
            leftsecondBgImageEl,
            leftmostBgImageEl,
            rightsecondBgImageEl,
            rightmostBgImageEl
          ];
          const infosArray = [
            currentInfoEl,
            previousInfoEl,
            nextInfoEl,
            leftsecondInfoEl,
            leftmostInfoEl,
            rightsecondInfoEl,
            rightmostInfoEl
          ];
          this.changeInfo(direction, buttons, infosArray);
          this.swapCardsClass(direction, cardsArray, bgsArray);
          this.rerenderEdgeImageCard(
            direction,
            infosArray,
            cardsArray,
            bgsArray
          );

          this.removeCardEvents(currentCardEl);
        });
      },
      300,
      {
        leading: true,
        trailing: false
      }
    ),

    initializeAnimatedImages() {
      const buttons = {
        prev: document.querySelector(".btn--left"),
        next: document.querySelector(".btn--right")
      };
      const cardsContainerEl = document.querySelector(".cards__wrapper");

      const cardInfosContainerEl = document.querySelector(".info__wrapper");
      this.initCardEvents();

      const init = () => {
        let tl = gsap.timeline();
        tl.to(cardsContainerEl.children, {
          delay: 0.15,
          duration: 0.5,
          stagger: {
            ease: "power4.inOut",
            from: "right",
            amount: 0.1
          },
          "--card-translateY-offset": "0"
        })
          .to(
            cardInfosContainerEl
              .querySelector(".current--info")
              .querySelectorAll(".text"),
            {
              delay: 0.5,
              duration: 0.4,
              stagger: 0.1,
              opacity: 1,
              translateY: 0
            }
          )
          .to(
            [buttons.prev, buttons.next],
            {
              duration: 0.4,
              opacity: 1,
              pointerEvents: "all"
            },
            "-=0.4"
          );
      };

      const waitForImages = () => {
        const images = [...document.querySelectorAll("img")];
        const totalImages = images.length;
        let loadedImages = 0;
        const loaderEl = document.querySelector(".loader span");

        gsap.set(cardsContainerEl.children, {
          "--card-translateY-offset": "100vh"
        });
        gsap.set(
          cardInfosContainerEl
            .querySelector(".current--info")
            .querySelectorAll(".text"),
          {
            translateY: "40px",
            opacity: 0
          }
        );
        gsap.set([buttons.prev, buttons.next], {
          pointerEvents: "none",
          opacity: "0"
        });

        images.forEach((image) => {
          imagesLoaded(image, (instance) => {
            if (instance.isComplete) {
              loadedImages++;
              let loadProgress = loadedImages / totalImages;

              gsap.to(loaderEl, {
                duration: 1,
                scaleX: loadProgress,
                backgroundColor: `hsl(${loadProgress * 120}, 100%, 50%)`
              });

              if (totalImages == loadedImages) {
                gsap
                  .timeline()
                  .to(".loading__wrapper", {
                    // delay 1 second to resolve cached image scenario and display
                    // the loading bar as full
                    delay: 1,
                    duration: 0.8,
                    opacity: 0,
                    pointerEvents: "none"
                  })
                  .call(() => init());
              }
            }
          });
        });
      };

      waitForImages();
    },

    executeWholeBoostArt() {
      // reset loader bar to 0%
      const loaderEl = document.querySelector(".loader span");
      gsap.set(loaderEl, {
        duration: 1,
        scaleX: 0,
        backgroundColor: `hsl(${0 * 120}, 100%, 50%)`
      });
      // keep leftmenu overlay the loading layout
      const leftMenu = document.querySelector(".navigation-view-container");
      gsap.set(leftMenu, {
        "z-index": "250"
      });
      // show the loading layout
      const loadingWrapper = document.querySelector(".loading__wrapper");
      gsap.set(loadingWrapper, {
        "pointer-events": "unset",
        opacity: "unset"
      });
      // move the previous image boxes below the screen
      const cardsContainerEl = document.querySelector(".cards__wrapper");
      gsap.set(cardsContainerEl.children, {
        "--card-translateY-offset": "100vh"
      });

      gsap.to(loaderEl, {
        duration: 1,
        scaleX: 0,
        backgroundColor: `hsl(${0 * 120}, 100%, 50%)`
      });

      this.initializeImagesData(this.genre).then(() => {
        this.mobile = window.innerWidth <= 450;
        if (this.mobile) {
          this.cardsContainerEl.children.forEach((card) => {
            card.setAttribute("touchstartListener", "true");
            card.addEventListener("touchstart", (e) => {
              this.touchStart(e);
            });
          });
        }
        if (this.firstPaintedDetector) {
          this.initializeAnimatedImages();
        } else {
          setTimeout(() => {
            this.initializeAnimatedImages();
          }, 1000);
        }
      });

      // Trick to prevent image sharp rendering
      this.$nextTick(() => {
        this.leftPushImagesData(this.genre);
        this.rightPushImagesData(this.genre);
      });

      !this.documentEvtFunc && this.registerKeyboardEvent();
    }
  },

  mounted() {
    // Initial Carousel Render
    setTimeout(() => {
      this.executeWholeBoostArt();
    }, 1000);
  },

  beforeDestroy() {
    this.terminateKeyboardEvent();
  }
});

new Vue({
  el: "#app",
  store
});
