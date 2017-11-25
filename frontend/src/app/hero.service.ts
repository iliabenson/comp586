import { Injectable } from '@angular/core';
import { Hero } from './hero';
import { HEROES } from './mock-heroes';
import { Observable } from 'rxjs/Observable';
import { of } from 'rxjs/observable/of';
import { MessageService } from './message.service';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Injectable()
export class HeroService {

  private heroesUrl = 'api/heroes';  // URL to web api

  // getHeroes(): Observable<Hero[]> {
  //   // Todo: send the message _after_ fetching the heroes
  //   this.log('fetched heroes');
  //   return of(HEROES);
  // }
  /** GET heroes from the server */
  getHeroes(): Observable<Hero[]> {
    // Todo: send the message _after_ fetching the heroes
    this.log('fetched heroes');
    return this.http.get<Hero[]>(this.heroesUrl)
  }

  getHero(id: number): Observable<Hero> {
    // Todo: send the message _after_ fetching the hero
    this.log(`fetched hero id=${id}`);
    return of(HEROES.find(hero => hero.id === id));
  }

  /** Log a HeroService message with the MessageService */
  private log(message: string) {
    this.messageService.add('HeroService: ' + message);
  }

  constructor(
    private http: HttpClient,
    private messageService: MessageService) { }
}
