import { TestBed, async, inject } from '@angular/core/testing';
import { HttpModule, Http, Response, ResponseOptions, XHRBackend } from '@angular/http';
import { MockBackend } from '@angular/http/testing';
import { HeroService } from './hero.service';
import { Hero } from './hero';

describe('HeroService', () => {

  beforeEach(() => {

    TestBed.configureTestingModule({
      imports: [HttpModule],
      providers: [
        // { provide: heroesUrl, useValue: 'http://ec2-34-215-152-141.us-west-2.compute.amazonaws.com/api/heroes' },
        HeroService,
        { provide: XHRBackend, useClass: MockBackend },
      ]
    });
  });

  describe('getHeroes()', () => {

    it('should return an Observable<Hero[]>',
        inject([HeroService, XHRBackend], (heroService, mockBackend) => {

        const mockResponse = {
          Hero: [
            { id: 0, name: 'Narco' },
            { id: 1, name: 'Bombasto' },
            { id: 2, name: 'Celeritas' },
            { id: 3, name: 'Magneta' },
          ]
        };

        mockBackend.connections.subscribe((connection) => {
          connection.mockRespond(new Response(new ResponseOptions({
            body: JSON.stringify(mockResponse)
          })));
        });

        heroService.getHeroes().subscribe((heroes) => {
          expect(heroes.length).toBe(4);
          expect(heroes[0].name).toEqual('Narco');
          expect(heroes[1].name).toEqual('Bombasto');
          expect(heroes[2].name).toEqual('Celeritas');
          expect(heroes[3].name).toEqual('Magneta');
        });

    }));
  });
});
